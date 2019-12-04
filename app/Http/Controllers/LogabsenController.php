<?php

namespace App\Http\Controllers;

use App\LogAbsen;
use Illuminate\Http\Request;
use Telegram;
use Yajra\DataTables\Facades\DataTables;


// '340074117','580331755', '318257876', '309322044', '249243957', '253088341', '301586792', /*P. Aziz*/'656236788', /*Pak Dwijo*/ '264390241', /*B. Devi*/ '329815907', /*P. AGung */ '827284422'
class LogabsenController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = date('w');
        $today = $haris[$day];
        $date = date('Y-m-d');

        $jadwals = \App\LogAbsen::where(['hari' => $today, 'tanggal' => $date])->with('gurus', 'mapels', 'rombels')->orderBy('rombel_id', 'asc')->get();

        return Datatables::of($jadwals)->make(true);
    }

    // Get Data Absen ku (guru)
    public function absenKu(Request $request)
    {
        $absenkus = \App\LogAbsen::where('guru_id', $request->user()->nip)->get();



        return view('index', ['page' => 'absenku', 'mode' => 'absenkus', 'datas' => $absenkus]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {
        
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = date('w');
        $today = $haris[$day];
        $date = date('Y-m-d');

        // Lihat Mapel Hari ini
        $jadwals = 'App\Jadwal'::where(['hari' => $today, 'status' => 'aktif'])->get(); 
        if($jadwals->count() < 1) {
            return response()->json(['status'=>'kosong', 'msg' => 'Hari ini jadwal kosong.']);
        } else {
            try {
                $jml_absens = $jadwals->count();
                $aktif = 0;
                $tdk_aktif = 0;

                foreach($jadwals as $jadwal) {
                    if (!$jadwal->gurus) {
                        $tdk_aktif++;
                    } else {
                        $kode_absen = $today.'_'.$date.'_'.$jadwal->guru_id.'_'.$jadwal->mapel_id.'_'.$jadwal->rombel_id.'_'.$jadwal->jamke;
                        \App\LogAbsen::create([
                            'kode_absen' => $kode_absen,
                            'hari' => $today,
                            'tanggal' => $date,
                            'guru_id' => $jadwal->guru_id,
                            'mapel_id' => $jadwal->mapel_id,
                            'rombel_id' => $jadwal->rombel_id,
                            'jamke' => $jadwal->jamke,
                            'jml_siswa' => 0,
                            'hadir' => 0,
                            'ijin' => 0,
                            'sakit' => 0,
                            'alpa' => 0,
                            'telat' => 0,
                            'jurnal' => 0,
                            'ket' => 'jamkos',
                            'isActive' => 1
                        ]);
                        $aktif++;
                    }
                }
                $erM = ($tdk_aktif > 0) ? 'Ada data tidak sesuai di jadwal pelajaran. Mohon dicek ulang data jadwal pelajaran. Mungkin ada jadwal tanpa guru atau rombel. ;)' : '';
                $msg = 'Jadwal Absensi hari '.$today.' telah diaktifkan. Aktif = '.$aktif.', Tidak Aktif = '.$tdk_aktif.'. Maaf. Uji Coba.';
                $kirim_telegram = $this->sendTelegram($msg);
                return response()->json(['status'=>'sukses', 'msg' => 'Jadwal hari ini aktif. Aktif = '.$aktif.', Tidak Aktif = '.$tdk_aktif.'. '.$erM]);
            } catch(\Exception $e)
            {
                if($e->getCode() == '23000') {
                    return response()->json(['status' => 'gagal', 'msg' => 'Jadwal hari ini sudah ditutup. Mohon hubungi admin untuk mengaktifkan kembali.', 'errCode' => $e->getCode()]);
                } else {
                    return response()->json(['status' => 'gagal', 'msg' => $e->getCode().' : '.$e->getMessage(),  'errCode' => $e->getCode()]);
                }
            }
        }

    }

    public function deactivate(Request $request)
    {
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = date('w');
        $today = $haris[$day];
        $date = date('Y-m-d');

        // Lihat Mapel Hari ini
        // $jadwals = 'App\Jadwaggl'::where(['hari' => $today, 'status' => 'aktif'])->get();
        try {
            $data = '';
            $ijins = '';

            $results = \App\LogAbsen::where(['tanggal' => $date, 'ket' => 'jamkos'])->get();
            foreach($results as $result)
            {
                $data .= $result->gurus->fullname.' '.$result->rombels->nama_rombel.' '.$result->jamke."\n";
            }

            $gijins = \App\LogAbsen::where(['tanggal' => $date, 'ket' => 'ijin'])->get();

            foreach($gijins as $gijin)
            {
                $ijins .= $gijin->gurus->fullname.' '.$gijin->rombels->nama_rombel.' '.$gijin->jamke."\n";
            }

            $cek = \App\LogAbsen::where(['tanggal' => $date, 'isActive' => '0'])->get();
            if($cek->count() > 0 ) {
                return response()->json(['status' => 'sukses', 'msg' => 'Jadwal Sudah ditutup']);
            } else {

                \App\LogAbsen::where('tanggal', $date)->update([
                    'isActive' => '0'
                ]);
                
                $msg = "<b>Maaf!, Uji coba ;) </b> \nJadwal Absensi hari ".$today.", ".date('d-m-Y'). " telah ditutup. \nGuru yang tidak melakukan absensi: \n".$data."\n \nGuru yang ijin: \n".$ijins;
                $kirim_telegram = $this->sendTelegram($msg);

                return response()->json(['status' => 'sukses', 'msg' => 'Absen hari ini telah ditutup.']);
            }
        } catch (\Exception $e)
        {
            if($e->getCode() == 400) {
                return response()->json(['status' => 'sukses', 'msg' => 'Absen hari ini telah ditutup.', 'errCode' => $e->getCode()]);
            } else {
                return response()->json(['status' => 'gagal', 'msg' => $e->getCode() .' : '. $e->getMessage(), 'errCode' => $e->getCode()]);
            }
        }
    }

    public function sendTelegram($msg)
    {
        $chatIds =  ['340074117','580331755', '318257876', '309322044', '249243957', '253088341', '301586792', /*P. Aziz '656236788', /*Pak Dwijo '264390241', /*B. Devi '329815907', /*P. AGung */ '827284422'];
        try {
            foreach($chatIds as $chatId)
            {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $msg
                ]);
            }
            return json_encode(['status' => 'sukses']);
        } catch(\Exception $e)
        {
            return json_encode(['status' => 'error', 'errorMessage' => $e->getMessage()]);
        }

    }

    public function hari()
    {
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = date('w');
        $today = $haris[$day];
        $date = date('Y-m-d');
        $tanggal = date('d-m-Y');

        return ['hari' => $today, 'tanggal' => $tanggal, 'date' => $date];
    }

    public function ijinkanGuru(Request $request)
    {
        $kode_absen = $request->input('kode_absen');
        try {
            LogAbsen::where('kode_absen', $kode_absen)->update([
                'ket' => 'ijin'
            ]);

            $guru = \App\User::where('nip', $request->input('nip'))->first();
            $absen = explode('_', $kode_absen);
            \App\IjinGuru::create([
                'kode_absen' => $kode_absen,
                'tanggal' => $this->hari()['date'],
                'keperluan'  => $request->input('keperluan'),
                'tugas_siswa' => ($request->input('tugas')) ? $request->input('tugas') : 'Tidak ada Tugas',
                'ket'        => $request->input('ket')
            ]);
            // $today.'_'.$date.'_'.$jadwal->guru_id.'_'.$jadwal->mapel_id.'_'.$jadwal->rombel_id.'_'.$jadwal->jamke;
            $absen = explode('_', $kode_absen);
            $mapel = \App\Mapel::where('kode_mapel', $absen[3])->first();

            $text = "Info: Uji Coba. ;) \nGuru a.n. ".$guru->fullname." pada hari: ".$this->hari()['hari']. "\ntanggal: ".$this->hari()['tanggal']."\nkelas: ".$absen[4]."\nmapel: ".$mapel->nama_mapel."\njamke: ".$absen[5]."\nMemohon ijin tidak masuk karena ada keperluan: ".$request->input('keperluan')."\nTugas Siswa: \n".$request->input('tugas').".\nKet: \n".$request->input('ket');
        
            $kirim_telegram = $this->sendTelegram($text);
            return response()->json(['status' => 'sukses', 'msg' => 'Guru telah dijinkan.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getCode()." : ".$e->getMessage()]);
        }
    }
}
