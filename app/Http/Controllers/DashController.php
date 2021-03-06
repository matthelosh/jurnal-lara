<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\User;
use Illuminate\Support\Facades\DB;

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
        $tanggal = date('d M Y');

        $logabsens = \App\LogAbsen::where(['hari' => $today, 'tanggal' => $date])->with('gurus', 'mapels', 'rombels')->orderBy('rombel_id', 'asc')->get();
        $jadwals = \App\LogAbsen::where(['guru_id' => Auth::user()->nip, 'hari' => $today, 'tanggal' => $date])->with('rombels', 'mapels')->get();

        $params = ['page' => 'dashboard', 'hari' =>$today, 'jadwals' => (Auth::user()->level == 'admin')?$logabsens:$jadwals];

        // if(Auth::user()->level == 'guru') {
        //     array_push($params, ['jadwals' => $jadwals]);
        // }

    	return view('index', ['page' => 'dashboard', 'hari' =>$today, 'jadwals' => $jadwals, 'tanggal' => $tanggal]);
    }
    public function detilUser(Request $request, $username) {
	$user = \App\User::where('username', $username)->first();
	return view('index', ['page' => 'detiluser', 'data' => $user]);
    }
    public function indexUsers()
    {
    	return view('index', ['page' => 'users']);
    }

    public function indexSiswa()
    {
        return view('index', ['page' => 'siswa']);
    }

    public function indexRombel()
    {
        return view('index', ['page' => 'rombel']);
    }

    public function indexMapel()
    {
        return view('index', ['page' => 'mapel']);
    }

    public function indexJadwal()
    {
        return view('index', ['page' => 'jadwal']);
    }

    public function indexSekolah()
    {
        $data = \App\Sekolah::first();
        return view('index', ['page' => 'sekolah', 'info_sekolah' => $data ]);
    }

    public function indexLaporan()
    {
        return view('index', ['page' => 'laporan']);
    }

    public function indexPresensi()
    {
        return view('index', ['page' => 'laporan_presensi']);
    }

    public function indexJurnal()
    {
        return view('index', ['page' => 'laporan_jurnal']);
    }

    public function indexSetting()
    {
        return view('index', ['page' => 'pengaturan']);
    }
// End Admin

// Guru
    // public function indexGuru()
    // {
    //     // Get Today's Schedules
    //     $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    //     $day = date('w');
    //     $today = $haris[$day];
    //     $date = date('Y-m-d');

    //     $jadwals = \App\LogAbsen::where(['hari' => $today, 'tanggal' => $date])->with('gurus', 'mapels', 'rombels')->orderBy('rombel_id', 'asc')->get();
    //     $jadwals = \App\LogAbsen::where(['guru_id' => Auth::user()->nip, 'hari' => $today])->with('rombels', 'mapels')->get();

    //     return view('dash-guru.index', ['page' => 'dashboard', 'jadwals' => $jadwals]);
    // }

    public function profil($username)
    {
        $profil = 'App\User'::where('username', $username)->first();

        return view('index', ['page' => 'profilku']);
    }

    public function siswaku()
    {
        return view('index', ['page' => 'siswaku']);
    }

    public function rekapAbsen(Request $request)
    {
        $mod = $request->query('mod');
        
        if (!$mod || $mod == '' || $mod == null) {
            $sekolah = 'App\Sekolah'::find(1);
            $rombel = 'App\Rombel'::where('guru_id', $request->user()->nip)->first();
            $logs = 'App\LogAbsen'::where(['rombel_id' => $rombel->kode_rombel, 'ket' => 'diabsen'])->with('mapels', 'gurus')->paginate(5);
            return view('index', ['page' => 'rekap_absen', 'rombel' =>$rombel, 'logs' => $logs, 'sekolah' => $sekolah, 'mod' => 'default']);
        } else {
            $nisn = $request->query('nisn');
            $bulan = $request->query('bulan');
            $tahun = $request->query('tahun');
            $siswa = 'App\Siswa'::where('nisn', $nisn)->first();
            $data = 'App\Absen'::with('logabsens')
                                ->where('siswa_id', $nisn)
                                ->whereRaw('MONTH(tanggal) = ?', [$bulan])
                                ->whereRaw('YEAR(tanggal) = ?', [$tahun])
                                ->orderBy('tanggal')
                                ->get();

            return view('index', ['page' => 'rekap_absen', 'datas' => $data, 'mod' => 'detil_rekap', 'siswa' => $siswa]);
        }
        
    }

// End Guru
// Ka Tu
    public function indexStafs(Request $request)
    {
        return view('index', ['page' => 'stafs']);
    }
}
