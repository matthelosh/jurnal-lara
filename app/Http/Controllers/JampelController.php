<?php

namespace App\Http\Controllers;

use App\Jampel;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class JampelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Datatables::of(Jampel::all())->addIndexColumn()->make(true);
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
            Jampel::create([
                'label' =>$request->input('label'),
                'mulai' => $request->input('mulai'),
                'selesai' => $request->input('selesai')
            ]);

            return response(['status' => 'sukses', 'msg' => 'Data Jam Pelajaran Baru Tersimpan']);
        } catch (\Exception $e) {
            return response(['status' => 'gagal', 'msg' => $e->getCode().": ".$e->getMessage()]);
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
     * @param  \App\Jampel  $jampel
     * @return \Illuminate\Http\Response
     */
    public function show(Jampel $jampel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jampel  $jampel
     * @return \Illuminate\Http\Response
     */
    public function edit(Jampel $jampel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jampel  $jampel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            Jampel::find($id)->update([
                'label' => $request->input('label'),
                'mulai' => $request->input('mulai'),
                'selesai' => $request->input('selesai')
            ]);
            return response()->json(['status' => 'sukses', 'msg' => 'Jam Pelajaran ini telah diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode().' : '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jampel  $jampel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $jampel)
    {
        //
        try {
            Jampel::find($jampel)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Jampel terhapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }
}
