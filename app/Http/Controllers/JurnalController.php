<?php

namespace App\Http\Controllers;

use App\Jurnal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class JurnalController extends Controller
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
    public function jurnalKu(Request $request)
    {
        $jurnals = 'App\Jurnal'::where('staf_id', $request->user()->nip)->with('stafs')->get();

        return DataTables::of($jurnals)->addIndexColumn()->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->input('tanggal'));
        try {
            Jurnal::create([
                'kode_jurnal' => $this->rand('0123456789ABCDEF'),
                'staf_id' => $request->user()->nip,
                'lokasi' => $request->input('lokasi'),
                'tanggal' => $request->input('tanggal'),
                'kegiatan' => $request->input('kegiatan'),
                'mulai' => $request->input('mulai'),
                'selesai' => $request->input('selesai'),
                'status' => '0',
                'ket' => 'proses'
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Jurnal terisi']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode(). ': '.$e->getMessage()]);
        }
    }

    // Get Jurnal Staf
    public function jurnalStaf(Request $request, $tanggal)
    {
        $date = ($tanggal == 'today') ? date('Y-m-d') : $tanggal;
        $jurnals = Jurnal::where('tanggal', $date)->get();

        return DataTables::of(Jurnal::where('tanggal',$date)->with('stafs')->get())->addIndexColumn()->make(true);
    }

    public function validasi(Request $request, $valid, $kode_jurnal)
    {
        $status = ($valid == 'validate') ? '1' : '0';
        try {
            
            $put = Jurnal::where('kode_jurnal', $kode_jurnal)->update(['status' => $status]);
            // dd($status);
            return response()->json(['status' => 'sukses', 'msg' => 'Jurnal Telah divalidasi/diinvalidasi']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode().': '.$e->getMessage()]);
        }
    }

    public function laporan(Request $request)
    {
        $staf = $request->query('staf');
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        try {
            $laporan = Jurnal::where('staf_id', $staf)
                               ->whereRaw('MONTH(tanggal) = ?', [$bulan])
                               ->whereRaw('YEAR(tanggal) = ?', [$tahun])
                               ->orderBy('tanggal')
                               ->orderBy('mulai')
                               ->orderBy('selesai')
                               ->get();
            
            return DataTables::of($laporan)->addIndexColumn()->make(true);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function show(Jurnal $jurnal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurnal $jurnal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jurnal)
    {
        //
        try
        {
            Jurnal::where('kode_jurnal', $jurnal)->update([
                'ket' => $request->input('newKet')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Jurnal Anda: '.$jurnal.' telah di'.$request->input('newket').'kan.']);
        } catch (\Exception $e) 
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode.': '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurnal $jurnal)
    {
        //
    }
    public function rand($input,$strength=6)
    {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return $random_string;
    }
}
