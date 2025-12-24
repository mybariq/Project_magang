<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AnggotaDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session('anggota_id')) {
                return redirect()->route('anggota.login');
            }
            return $next($request);
        });
    }

    public function dashboard(Request $request): View
    {
        $anggotaId = session('anggota_id');
        $anggotaNama = session('anggota_nama');
        $status = $request->query('status');

        // Include pengaduans assigned by anggota_id OR legacy rows where anggota name matches and anggota_id is NULL
        $pengaduans = Pengaduan::where(function ($q) use ($anggotaId, $anggotaNama) {
                $q->where('anggota_id', $anggotaId)
                  ->orWhere(function ($q2) use ($anggotaNama) {
                      $q2->whereNull('anggota_id')->whereRaw('lower(anggota) = ?', [strtolower($anggotaNama)]);
                  });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $counts = [
            'baru' => Pengaduan::where(function ($q) use ($anggotaId, $anggotaNama) {
                $q->where('anggota_id', $anggotaId)->orWhere(function ($q2) use ($anggotaNama) {
                    $q2->whereNull('anggota_id')->whereRaw('lower(anggota) = ?', [strtolower($anggotaNama)]);
                });
            })->where('status', 'baru')->count(),
            'diproses' => Pengaduan::where(function ($q) use ($anggotaId, $anggotaNama) {
                $q->where('anggota_id', $anggotaId)->orWhere(function ($q2) use ($anggotaNama) {
                    $q2->whereNull('anggota_id')->whereRaw('lower(anggota) = ?', [strtolower($anggotaNama)]);
                });
            })->where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where(function ($q) use ($anggotaId, $anggotaNama) {
                $q->where('anggota_id', $anggotaId)->orWhere(function ($q2) use ($anggotaNama) {
                    $q2->whereNull('anggota_id')->whereRaw('lower(anggota) = ?', [strtolower($anggotaNama)]);
                });
            })->where('status', 'selesai')->count(),
            'semua' => Pengaduan::where(function ($q) use ($anggotaId, $anggotaNama) {
                $q->where('anggota_id', $anggotaId)->orWhere(function ($q2) use ($anggotaNama) {
                    $q2->whereNull('anggota_id')->whereRaw('lower(anggota) = ?', [strtolower($anggotaNama)]);
                });
            })->count(),
        ];

        return view('anggota.dashboard', compact('pengaduans', 'status', 'counts'));
    }

    public function show(Pengaduan $pengaduan)
    {
        // Allow access if anggota_id matches OR legacy row with anggota name matches logged-in anggota
        $allowed = ($pengaduan->anggota_id == session('anggota_id')) || (is_null($pengaduan->anggota_id) && $pengaduan->anggota && strtolower(trim($pengaduan->anggota)) == strtolower(trim(session('anggota_nama'))));
        if (! $allowed) {
            abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
        }

        return view('anggota.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        // Allow status change if anggota matches by id or legacy name
        $allowed = ($pengaduan->anggota_id == session('anggota_id')) || (is_null($pengaduan->anggota_id) && $pengaduan->anggota && strtolower(trim($pengaduan->anggota)) == strtolower(trim(session('anggota_nama'))));
        if (! $allowed) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status pengaduan ini.');
        }



        // If pengaduan already selesai, do not allow changing status or replacing bukti_foto
        if ($pengaduan->status === 'selesai') {
            if ($request->has('status') && $request->input('status') !== 'selesai') {
                return back()->with('error', 'Pengaduan sudah selesai — status tidak dapat diubah.');
            }
            if ($request->hasFile('bukti_foto')) {
                return back()->with('error', 'Pengaduan sudah selesai — bukti foto tidak dapat diubah.');
            }

            $rules = [
                'status' => ['nullable', 'in:diproses,selesai'],
                'bukti_foto' => ['nullable', 'image', 'max:5120'],
            ];

            $data = $request->validate($rules);

            return back()->with('info', 'Pengaduan sudah selesai. Tidak ada perubahan pada status atau bukti foto.');
        }

        // not yet selesai — allow normal updates
        $isBecomingSelesai = ($pengaduan->status !== 'selesai' && $request->input('status') === 'selesai');

        $rules = [
            'status' => ['required', 'in:diproses,selesai'],
        ];

        if ($isBecomingSelesai) {
            $rules['bukti_foto'] = ['required', 'image', 'max:5120']; // max 5MB
        } else {
            $rules['bukti_foto'] = ['nullable', 'image', 'max:5120'];
        }

        $data = $request->validate($rules);

        // handle file upload if present
        if ($request->hasFile('bukti_foto')) {
            // delete previous file if any
            if ($pengaduan->bukti_foto) {
                Storage::disk('public')->delete($pengaduan->bukti_foto);
            }
            $path = $request->file('bukti_foto')->store('bukti', 'public');
            $pengaduan->bukti_foto = $path;
        }

        $pengaduan->status = $data['status'];



        $pengaduan->save();

        return back()->with('success', 'Status pengaduan diperbarui.');
    }
}
