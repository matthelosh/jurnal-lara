<?php

namespace App\Http\Controllers;

use App\Rombel;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;

class RombelController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //v
        if($request->query('mode') == 'select') {
            $rombels = Rombel::all();
            return response()->json($rombels);
        } else {
            $jml =[];
            $rombels = Rombel::with(['siswas','gurus'])->get();
            
            return Datatables::of($rombels)->addColumn('jml_siswa', function($rombel){
                    return $rombel->siswas->count();
                })->addIndexColumn()->make(true);
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
        try {
            Rombel::create([
                'kode_rombel' => $request->input('kode_rombel'),
                'nama_rombel' => $request->input('nama_rombel'),
                'guru_id'     => $request->input('guru_id')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Data Rombel: '.$request->input('nama_rombel').' telah dibuat']);
        } catch(\Illuminate\Database\QueryException $e) {

            return response()->json(['staus' => 'gagal', 'msg' => $e->getMesage()]);
        } catch (Exception $e) {
            return response()->json(['staus' => 'gagal', 'msg' => $e->getMesage()]);
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
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function show(Rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function edit(Rombel $rombel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rombel)
    {
        //
        try {
            Rombel::find($rombel)->update([
                'kode_rombel' => $request->input('kode_rombel'),
                'nama_rombel' => $request->input('nama_rombel'),
                'guru_id'     => $request->input('guru_id')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Data Rombel: '.$request->input('nama_rombel').' diperbarui.']);
        } catch (Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rombel  $rombel
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $rombel)
    {
        //
        try {
            Rombel::where('id', $rombel)->delete();

            return response()->json(['status' => 'sukses', 'msg' => 'Data Rombel: '.$rombel.' dihapus.']);
        } catch (Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }
}
