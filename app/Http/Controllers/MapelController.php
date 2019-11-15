<?php

namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Imports\MapelsImport;
use Maatwebsite\Excel\Facades\Excel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->query('mode') == 'non-dt') {
            $mapels = Mapel::all();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Mapel', 'data' => $mapels]);
        } else {
            return Datatables::of(Mapel::all())->addIndexColumn()->make(true);
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
        // dd($request->input());
        try {
            Mapel::create([
                'kode_mapel' => $request->input('kode_mapel'),
                'nama_mapel' => $request->input('nama_mapel')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Data Mapel baru tersimpan.']);
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        } catch(\Illuminate\Database\QueryException $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }



    /**
     * Import Data from spreadsheet
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $file = $request->file('fileMapel');
        try {
            Excel::import(new MapelsImport, $file);
            $file->store('files');

            return redirect('/dashboard/mapel')->with(['status' => 'sukses', 'msg' => 'Data Mapel berhasil diimport']);
        } catch (\Exception $e) {
            if ($e->getCode() == '23000') {
                return back()->with(['status' => 'gagal', 'msg' => 'Mohon Dicek lagi. Ada Mapel yang sama.']);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return back()->with(['status' => 'gagal', 'msg' => 'Mohon Dicek lagi. Ada Mapel yang sama.']);
            } else {
                return back()->with(['status' => 'gagal', 'msg' => $e->getMEssage()]);
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
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $mapel_id = $request->input('mapel_id');
        try {
            Mapel::find($request->query('id'))->update([
                'kode_mapel' => $request->input('kode_mapel'),
                'nama_mapel' => $request->input('nama_mapel')
            ]);
            return response()->json(['status' => 'sukses', 'msg' => 'Mapel '.$request->input('nama_mapel').' berhasil diperbarui.']);
        }catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $mapel_id)
    {
        //
        try {
            Mapel::find($mapel_id)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Mapel telah dihapus.']);
        } catch (Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }

    }
}
