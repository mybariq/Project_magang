<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KetuaDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session('ketua_id')) {
                return redirect()->route('ketua.login');
            }
            return $next($request);
        });
    }

    public function dashboard(Request $request): View
    {
        $ketuaId = session('ketua_id');
        $ketuaKategori = session('ketua_kategori');
        $status = $request->query('status');

        // Tampilkan pengaduan yang ditugaskan ke ketua ini atau yang belum ditugaskan tapi termasuk kategori ketua
        $pengaduans = Pengaduan::where(function ($query) use ($ketuaId, $ketuaKategori) {
                $query->where('ketua_id', $ketuaId)
                      ->orWhere(function ($q) use ($ketuaKategori) {
                          $q->whereNull('ketua_id')->where('kategori', $ketuaKategori);
                      });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $counts = [
            'baru' => Pengaduan::where(function ($q) use ($ketuaId, $ketuaKategori) {
                $q->where('ketua_id', $ketuaId)->orWhere(function ($q2) use ($ketuaKategori) {
                    $q2->whereNull('ketua_id')->where('kategori', $ketuaKategori);
                });
            })->where('status', 'baru')->count(),
            'diproses' => Pengaduan::where(function ($q) use ($ketuaId, $ketuaKategori) {
                $q->where('ketua_id', $ketuaId)->orWhere(function ($q2) use ($ketuaKategori) {
                    $q2->whereNull('ketua_id')->where('kategori', $ketuaKategori);
                });
            })->where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where(function ($q) use ($ketuaId, $ketuaKategori) {
                $q->where('ketua_id', $ketuaId)->orWhere(function ($q2) use ($ketuaKategori) {
                    $q2->whereNull('ketua_id')->where('kategori', $ketuaKategori);
                });
            })->where('status', 'selesai')->count(),
            'semua' => Pengaduan::where(function ($q) use ($ketuaId, $ketuaKategori) {
                $q->where('ketua_id', $ketuaId)->orWhere(function ($q2) use ($ketuaKategori) {
                    $q2->whereNull('ketua_id')->where('kategori', $ketuaKategori);
                });
            })->count(),
        ];

        // fetch unread perhatian notifications relevant to this ketua
        $notifications = \Illuminate\Support\Facades\DB::table('perhatian_notifications')
            ->join('pengaduans', 'perhatian_notifications.pengaduan_id', '=', 'pengaduans.id')
            ->where(function ($q) use ($ketuaId, $ketuaKategori) {
                $q->where('perhatian_notifications.ketua_id', $ketuaId)
                  ->orWhere(function ($q2) use ($ketuaKategori) {
                      $q2->whereNull('perhatian_notifications.ketua_id')->where('pengaduans.kategori', $ketuaKategori);
                  });
            })
            ->where('perhatian_notifications.is_read', false)
            ->select('perhatian_notifications.*', 'pengaduans.judul', 'pengaduans.kategori')
            ->orderBy('perhatian_notifications.created_at', 'desc')
            ->get();

        $notificationsCount = $notifications->count();

        return view('ketua.dashboard', compact('pengaduans', 'status', 'counts', 'ketuaKategori', 'notifications', 'notificationsCount'));
    }

    public function show(Pengaduan $pengaduan): View
    {
        // Izinkan akses jika pengaduan ditugaskan ke ketua ini atau pengaduan belum ditugaskan dan termasuk kategori ketua
        if ($pengaduan->ketua_id != session('ketua_id') && !($pengaduan->kategori == session('ketua_kategori') && is_null($pengaduan->ketua_id))) {
            abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
        }

        $anggotaList = collect();
        if ($pengaduan->kategori) {
            $anggotaList = \App\Models\Anggota::where('kategori', $pengaduan->kategori)->get();
            if ($anggotaList->isEmpty() && config("ketua_anggota.{$pengaduan->kategori}")) {
                $anggotaList = collect(config("ketua_anggota.{$pengaduan->kategori}.anggota", []))->map(function ($a) {
                    return (object)['id' => null, 'nama' => $a];
                });
            }
        }

        // Jika anggota sudah ditetapkan, ambil nama resminya (jika ada)
        if ($pengaduan->anggota_id) {
            $pengaduan->anggota = optional(\App\Models\Anggota::find($pengaduan->anggota_id))->nama ?: $pengaduan->anggota;
        }

        return view('ketua.show', compact('pengaduan', 'anggotaList'));
    }

    public function assignAnggota(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        // Izinkan assign jika pengaduan sudah ditugaskan ke ketua ini
        // atau pengaduan belum ditugaskan dan termasuk kategori ketua (ketua berhak menetapkan)
        if ($pengaduan->ketua_id != session('ketua_id') && !($pengaduan->kategori == session('ketua_kategori') && is_null($pengaduan->ketua_id))) {
            abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
        }

        // menerima anggota_id atau anggota name dari form (id OR name)
        $data = $request->validate([
            'anggota_id' => ['required', 'string', 'max:150'],
        ]);

        $choice = trim($data['anggota_id']);
        $anggotaModel = null;

        // If numeric, treat as id, otherwise try to match by name (case-insensitive)
        if (is_numeric($choice)) {
            $anggotaModel = \App\Models\Anggota::find((int)$choice);
        } else {
            $anggotaModel = \App\Models\Anggota::whereRaw('lower(nama) = ?', [strtolower($choice)])->first();
        }

        if ($anggotaModel) {
            $pengaduan->anggota_id = $anggotaModel->id;
            $pengaduan->anggota = $anggotaModel->nama;
        } else {
            // store name-only if we cannot resolve an id
            $pengaduan->anggota_id = null;
            $pengaduan->anggota = $choice;
        }

        // Jika pengaduan belum memiliki ketua, tetapkan ketua saat ini
        if (is_null($pengaduan->ketua_id)) {
            $pengaduan->ketua_id = session('ketua_id');
            $pengaduan->ketua = session('ketua_nama');
        }

        $pengaduan->save();

        return back()->with('success', 'Anggota berhasil ditugaskan.');
    }
}
