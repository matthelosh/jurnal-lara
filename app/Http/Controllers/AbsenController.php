<?php

namespace App\Http\Controllers;

use App\Absen;
use Cron\MonthField;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // Perform Absen for Guru Mapel
    public function doAbsen(Request $request, $kode_absen)
    {
        $kode = explode('_', $kode_absen);
        $rombel_id = $kode[4];
        $siswas = \App\Siswa::where('rombel_id', $rombel_id)->get();
        $mapel = \App\Mapel::where('kode_mapel', $kode[3])->first();
        $rombel = \App\Rombel::where('kode_rombel', $rombel_id)->first();

        return view('index', ['page' => 'absen', 'siswas' => $siswas, 'mapel' => $mapel, 'rombel' => $rombel, 'kode_absen' => $kode_absen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAbsen(Request $request)
    {
        $nisns = $request->input('nisn');
        

        try {
            $jh = 0;
            $ji = 0;
            $js = 0;
            $ja = 0;
            $jt = 0;
            foreach($nisns as $nisn)
            {
                $ket = $request->input('ket-'.$nisn);

                if ($ket == 'h') {
                    $jh++;
                } elseif($ket == 'i') {
                    $ji++;
                } elseif($ket == 's') {
                    $js++;
                } elseif($ket == 'a') {
                    $ja++;
                } else {
                    $jt++;
                }

                \App\Absen::create([
                    'absen_id' => $request->input('kode_absen'),
                    'siswa_id' => $nisn,
                    'tanggal' => date('Y-m-d'),
                    'ket' => $ket
                ]);
            }

            \App\LogAbsen::where('kode_absen', $request->input('kode_absen'))
                        ->update([
                            'jml_siswa' => count($nisns),
                            'hadir' => $jh,
                            'ijin' => $ji,
                            'sakit' => $js,
                            'alpa' => $ja,
                            'telat' => $jt,
                            'jurnal' => $request->input('jurnal'),
                            'ket' => 'diabsen'
                        ]);


            // return redirect('/dashboard');
            return response()->json(['status' => 'sukses', 'msg' => 'Data Absen disimpan. ;)']);
        } catch (\Exception $e) {
            // return back()->withErrors(['status' => 'error', 'errCode' => $e->getCode(), 'errMsg' => $e->geMessage()]);
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode().': '.$e->getMessage()]);
        }
    }

    public function absenKu(Request $request)
    {
        try {
            $absenkus = \App\Absen::where('guru_id', $request->user()->nip)->get();
            return view('index', ['page' => 'absenku', 'mode' => 'absenku', 'data' => $absenkus]);
        } catch (\Exception $e) {
            
        }
    }

    public function detilAbsen(Request $request, $kode_absen)
    {
        try {
            $jurnal = \App\LogAbsen::where('kode_absen', $kode_absen)->first();
            $detil_absen = \App\Absen::where('absen_id', $kode_absen)->with('siswas')->get();
            return view('index', ['page' => 'absenku', 'mode' => 'detil_absen', 'datas' => $detil_absen, 'kode_absen' => $kode_absen, 'jurnal' => $jurnal]);
        } catch (\Exception $e) {
            
        }
    }

    public function updatePresensi(Request $request, $nisn)
    {   
        try 
        {
            $kode_absen = $request->input('kode_absen');
            $new_ket = $request->input('newKet');
            $absen = \App\Absen::where(['absen_id' => $kode_absen, 'siswa_id' => $nisn ])->first();
            
            $old_ket = $absen->ket;
            
            
            $log_absen = \App\LogAbsen::where('kode_absen', $kode_absen)->first();
            $new_key = '';
            $old_key = '';
            if($new_ket == 'h') {
                $new_key = 'hadirs';
            } elseif($new_ket == 'i') {
                $new_key = 'ijin';
            } elseif ($new_ket == 's') {
                $new_key = 'sakit';
            } elseif ($new_ket == 'a') {
                $new_key = 'alpa';
            } else {
                $new_key = 'telat';
            }


            if ($old_ket == 'h') {
                $old_key = 'hadir';
            } elseif ($old_ket == 'i') {
                $old_key = 'ijin';
            } elseif ($old_ket == 's') {
                $old_key == 'sakit';
            } elseif($old_ket == 'a') {
                $old_key = 'alpa';
            } else {
                $old_key = 'telat';
            }
            // if ( $old_ket == 'h' ) {
                // if ( $new_ket)
                $log_absen->update([
                    $old_key => ($log_absen->$old_key - 1),
                    $new_key => ($log_absen->$new_key + 1)
                ]);
            // }
            $absen->update(['ket' => $new_ket]);
            return response()->json(['status' => 'sukses', 'msg' => 'Data presensi diperbarui.']);
        } catch(\Exception $e)
        {
            dd($e->getMessage());
        }
    }
    
    // Rekap Kelas
    public function rekapKelas(Request $request, $bulan, $tahun, $rombel)
    {
        // $Rombel = 'App\Rombel'::where('kode_rombel', $rombel)->first();
        // $wali = 'App\User'::where('nip', $Rombel->guru_id)->first();
        // $request->session()->put('wali_kelas',$wali->fullname);

        $siswas = 'App\Siswa'::where('rombel_id', $rombel)->get();
        $tgls = DB::table('absens')
                    ->select(DB::raw('DAY(tanggal) as tgl'))
                    ->where('absen_id', 'like', '%'.$rombel.'%')
                    ->whereRaw('MONTH(tanggal) = ?', [$bulan])
                    ->whereRaw('YEAR(tanggal) = ?', [$tahun])
                    ->groupBy('tanggal')
                    ->get();
        $datas = [];

        foreach($siswas as $siswa) {
            array_push($datas, ['nisn' => $siswa->nisn, 'nama_siswa' => $siswa->nama_siswa, 'h' => 0, 'i' => 0, 's' => 0, 'a' => 0, 't' => 0]);
        }
        $dumps =[];
        foreach($siswas as $siswa)
        {
            $dumps[$siswa->nisn] = [];
            foreach($tgls as $tgl)
            {
                // SELECT nis, tgl, GROUP_CONCAT(ket ORDER BY nis SEPARATOR ',') as keter FROM absen  WHERE nis='$res[nis]' AND MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' GROUP BY nis,tgl
                $ketPerTgl = Absen::select(DB::raw('GROUP_CONCAT(ket ORDER BY siswa_id SEPARATOR ",") as jmlKet'))
                    ->whereRaw('DAY(tanggal) = ?', [$tgl->tgl])
                    ->where('absen_id', 'like', '%'.$rombel.'%')
                    ->whereRaw('MONTH(tanggal) = ?', [$bulan])
                    ->whereRaw('YEAR(tanggal) = ?', [$tahun])
                    ->where('siswa_id', $siswa->nisn)
                    // ->groupBy('ket')
                    // ->orderBy('jml')
                    ->get();
                foreach($ketPerTgl as $ket)
                {
                    // if(!isset($dumps[$siswa->nisn][$tgl->tgl])){
                        $kets = explode(',',$ket->jmlKet);
                        $dumps[$siswa->nisn][$tgl->tgl] = max($kets);
                    // }
                }
            }
        }
        $i=0;

        foreach($datas as $data)
        {
            foreach($dumps as $key=>$value)
            {
                if($data['nisn'] == $key) {
                    $kets = array_count_values($value);
                    $datas[$i]['h'] = isset($kets['h']) ? $kets['h'] : 0;
                    $datas[$i]['i'] = isset($kets['i']) ? $kets['i'] : 0;
                    $datas[$i]['s'] = isset($kets['s']) ? $kets['s'] : 0;
                    $datas[$i]['a'] = isset($kets['a']) ? $kets['a'] : 0;
                    $datas[$i]['t'] = isset($kets['t']) ? $kets['t'] : 0;
                }
            }
            $i++;
        }

        $results = json_decode(json_encode($datas, FALSE));
        return DataTables::of($results)->addIndexColumn()->make(true);
        // dd($hs);
        // dd($datas);
    }

    // Detail Absen for Admin
    public function getDetil(Request $request, $kode)
    {
        $absen = Absen::where('absen_id', $kode)->with('siswas')->get();
        return DataTables::of($absen)->addIndexColumn()->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absen $absen)
    {
        //
    }
}
