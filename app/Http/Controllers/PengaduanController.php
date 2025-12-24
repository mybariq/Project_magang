<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Ketua;
use App\Models\Anggota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    /**
        * Menampilkan daftar pengaduan.
        */
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $pengaduans = Pengaduan::when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $counts = [
            'baru' => Pengaduan::where('status', 'baru')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
            'semua' => Pengaduan::count(),
        ];

        return view('pengaduan.index', compact('pengaduans', 'status', 'counts'));
    }

    /**
        * Form pengaduan baru.
        */
    public function create(): View
    {
        return view('pengaduan.create');
    }

    /**
        * Tampilkan daftar ketua dan anggota per kategori.
        */
    public function daftarKetuaAnggota(): View
    {
        $data = config('ketua_anggota', []);
        return view('pengaduan.daftar-ketua-anggota', compact('data'));
    }

    /**
        * Simpan pengaduan.
        */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'no_hp' => ['nullable', 'string', 'max:30'],
            'kategori' => ['required', 'in:Aplikasi,Jaringan,Persandian'],
            'judul' => ['required', 'string', 'max:200'],
            'isi' => ['required', 'string'],
            'bukti_foto' => ['nullable', 'image', 'max:5120'],
        ]);

        $data['status'] = 'baru';
        
        // Auto-assign ketua berdasarkan kategori
        $ketua = Ketua::where('kategori', $data['kategori'])->first();
        if ($ketua) {
            $data['ketua_id'] = $ketua->id;
            $data['ketua'] = $ketua->nama;
        }

        // Handle optional bukti foto upload
        if ($request->hasFile('bukti_foto')) {
            $path = $request->file('bukti_foto')->store('bukti', 'public');
            $data['bukti_foto'] = $path;
        }

        Pengaduan::create($data);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim dan telah ditetapkan ke ketua ' . ($ketua ? $ketua->nama : '') . '.');
    }

    /**
        * Detail pengaduan.
        */
    public function show(Pengaduan $pengaduan): View
    {
        $ketuaList = [];
        $anggotaList = [];
        
        if ($pengaduan->kategori && config("ketua_anggota.{$pengaduan->kategori}")) {
            $ketuaList = config("ketua_anggota.{$pengaduan->kategori}.ketua", []);
            $anggotaList = config("ketua_anggota.{$pengaduan->kategori}.anggota", []);
        }
        
        return view('pengaduan.show', compact('pengaduan', 'ketuaList', 'anggotaList'));
    }

    /**
        * Update status pengaduan (untuk admin/operator sederhana).
        */
    public function updateStatus(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:baru,diproses,selesai'],
        ]);

        $pengaduan->update($data);

        return back()->with('success', 'Status pengaduan diperbarui.');
    }

    /**
     * Update penugasan ketua (untuk admin).
     */
    public function assignKetua(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $data = $request->validate([
            'ketua' => ['required', 'string', 'max:150'],
        ]);

        $pengaduan->update($data);

        return back()->with('success', 'Ketua berhasil ditetapkan.');
    }

    /**
     * Update penugasan anggota (untuk ketua).
     */
    public function assignAnggota(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        // Untuk admin: menerima anggota_id sebagai penugasan
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggotas,id'],
        ]);

        $anggota = Anggota::find($data['anggota_id']);
        $pengaduan->anggota_id = $anggota->id;
        $pengaduan->anggota = $anggota->nama;
        $pengaduan->save();

        return back()->with('success', 'Anggota berhasil ditugaskan.');
    }

    /**
     * Hapus pengaduan (khusus petugas).
     */
    public function destroy(Pengaduan $pengaduan): RedirectResponse
    {
        $pengaduan->delete();

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan dihapus.');
    }
}

