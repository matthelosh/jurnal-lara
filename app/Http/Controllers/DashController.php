<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\User;

class DashController extends Controller
{
    //
    
    public function __construct()
    {
    	$this->middleware('auth');
    }
// Admin
    public function index()
    {
        // Get Today's Schedules
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = date('w');
        $today = $haris[$day];
        $date = date('Y-m-d');

        // $jadwals = \App\LogAbsen::where(['hari' => $today, 'tanggal' => $date])->with('gurus', 'mapels', 'rombels')->orderBy('rombel_id', 'asc')->get();


    	return view('dash-admin.index', ['page' => 'dashboard', 'hari' =>$today]);
    }

    public function indexUsers()
    {
    	return view('dash-admin.index', ['page' => 'users']);
    }

    public function indexSiswa()
    {
        return view('dash-admin.index', ['page' => 'siswa']);
    }

    public function indexRombel()
    {
        return view('dash-admin.index', ['page' => 'rombel']);
    }

    public function indexMapel()
    {
        return view('dash-admin.index', ['page' => 'mapel']);
    }

    public function indexJadwal()
    {
        return view('dash-admin.index', ['page' => 'jadwal']);
    }

    public function indexSekolah()
    {
        $data = \App\Sekolah::first();
        return view('dash-admin.index', ['page' => 'sekolah', 'info_sekolah' => $data ]);
    }

    public function indexSetting()
    {
        return view('dash-admin.index', ['page' => 'pengaturan']);
    }
// End Admin

// Guru
    public function indexGuru()
    {
        // Get Today's Schedules
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = date('w');
        $today = $haris[$day];
        $date = date('Y-m-d');

        $jadwals = \App\LogAbsen::where(['hari' => $today, 'tanggal' => $date])->with('gurus', 'mapels', 'rombels')->orderBy('rombel_id', 'asc')->get();
        $jadwals = \App\LogAbsen::where(['guru_id' => Auth::user()->nip, 'hari' => $today])->with('rombels', 'mapels')->get();

        return view('dash-guru.index', ['page' => 'dashboard', 'jadwals' => $jadwals]);
    }

// End Guru
}
