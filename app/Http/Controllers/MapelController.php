<?php

namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Imports\SiswasImport;
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
    public function update(Request $request, Mapel $mapel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        //
    }
}
