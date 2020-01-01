<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Imports\JadwalsImport;
use Maatwebsite\Excel\Facades\Excel;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jadwals = Jadwal::with('gurus', 'mapels', 'rombels')->get();
        if ($request->query('mode') == 'non-dt') {
            
            return response()->json(['status' => 'sukses', 'msg' => 'Data Mapel', 'data' => $jadwals]);
        } else {

            return Datatables::of($jadwals)->addIndexColumn()->make(true);
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('fileJadwal');
        try {
            $import = Excel::import(new JadwalsImport, $file);
            $file->move(public_path('files'), $file->getClientOriginalName().'.'.$file->getClientOriginalExtension());
            return redirect('/dashboard/jadwal');
        } catch (\Exception $e) {
            if($e->getCode() == 23000 ) {
                return back()->withErrors(['status' => 'gagal', 'msg' => 'Mohon Dicek lagi. Ada jadwal yang sama sudah ada dalam basis data.']);
            } else {
                return back()->withErrors(['status' => 'gagal', 'msg' => $e->getCode().' : '. $e->getMessage()]);
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $cek = Jadwal::where([
            'hari' => $request->input('hari'),
            'guru_id' => $request->input('nip_guru'),
            'jamke' => $request->input('start').'-'. $request->input('jamend')
        ])->with('rombels')->first();

        $cek2 = Jadwal::where([
            'hari' => $request->input('hari'),
            'rombel_id' => $request->input('rombel_id'),
            'jamke' => $request->input('start').'-'. $request->input('jamend')
        ])->with('users', 'rombels')->first();
        if ( $cek ) {
            return response()->json(['status' => 'gagal', 'msg' => 'Guru ini sudah ada jadwal di kelas '. $cek->rombels->nama_rombel . ' untuk hari '.$cek->hari. ', jam ke '.$cek->jamke]);
        } 
        if ( $cek2 ) {
            return response()->json(['status' => 'gagal', 'msg' => 'Rombel '.$cek2->rombels->nama_rombel.' hari '. $cek2->hari.', jam ke: '.$cek2->jamke.' diajar oleh '.$cek2->users->fullname]);
        } 

        try {
            $kode_jadwal = strtolower(substr($request->input('hari'), 0, 3)).'_'.$request->input('mapel_id').'_'.$request->input('rombel_id').'_'.$request->input('start').'-'. $request->input('jamend');
            Jadwal::create([
                'kode_jadwal' => $kode_jadwal,
                'hari' => $request->input('hari'),
                'guru_id' => $request->input('nip_guru'),
                'mapel_id' => $request->input('mapel_id'),
                'rombel_id' => $request->input('rombel_id'),
                'jamke' => $request->input('jamstart').'-'. $request->input('jamend')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Jadwal baru tersimpan']);
        // } catch (\Exception $e) {
        //     return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        } 
        catch(\Illuminate\Database\QueryException $e)
        {
            if($e->getCode() == 23000) {
                return response()->json(['status' => 'gagal', 'msg' => $e->getCode().' : Jadwal yang sama sudah ada di database.']);
            }
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
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try {
            $kode_jadwal = strtolower(substr($request->input('hari'), 0, 3)).'_'.$request->input('mapel_id').'_'.$request->input('rombel_id').'_'.$request->input('start').'-'. $request->input('jamend');
            Jadwal::find($id)->update([
                'kode_jadwal' => $kode_jadwal,
                'hari' => $request->input('hari'),
                'guru_id' => $request->input('nip_guru'),
                'mapel_id' => $request->input('mapel_id'),
                'rombel_id' => $request->input('rombel_id'),
                'jamke' => $request->input('jamstart').'-'. $request->input('jamend')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Jadwal diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode().':'.$e->getMessage() ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function delete($jadwal)
    {
        //
        try {
            Jadwal::find($jadwal)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Jadwal berhasil dihapus']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->geCode().' ; '.$e->getMessage()]);
        }
    }
}
