<?php

namespace App\Http\Controllers;

use App\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SekolahController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        // try {
        //     $sekolah = 'App\Sekolah'::first();
        //     return response()->json(['status' => 'sukses', 'msg' => 'Data Sekolah', 'data' => $sekolah]);
        //     dd($sekolah);
        // } catch(\Exception $e) {
        //     return response()->json(['status' => 'gagal', 'msg' => $e->getCode().': '.$e->getMessage()]);
     
        // }
        $sekolah = 'App\Sekolah'::first();
        return response()->json(['status' => 'sukses', 'msg' => 'Data Sekolah', 'data' => $sekolah]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function store(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        //
        try {
            $sekolah = Sekolah::first();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Sekolah', 'data' => $sekolah]);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try
        {
            Sekolah::find(1)->update([
                'npsn' => $request->input('npsn'), 
                'nss'  => $request->input('nss'), 
                'nama_sekolah' => $request->input('nama_sekolah'), 
                'kepsek' => $request->input('kepsek'), 
                'nip_kepsek' => $request->input('nip_kepsek'), 
                'lat' => $request->input('lat'),
                'long' => $request->input('long'),
                'alamat_sekolah' => $request->input('alamat_sekolah'), 
                'kelurahan' => $request->input('kelurahan'), 
                'kec' => $request->input('kec'), 
                'kota' => $request->input('kota'), 
                'prov' => $request->input('prov'), 
                'telepon' => $request->input('telepon'), 
                'email' => $request->input('email'), 
                'website' => $request->input('website')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Data sekolah diperbarui.']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode(). ' : '. $e->getMessage()]);
        }
    }

    public function updateLokasi(Request $request)
    {
        'App\Sekolah'::find(1)->update(['lat' => $request->input('lat'), 'long' => $request->input('long')]);
        return response()->json(['status' => 'sukses', 'msg' => 'Data lokasi diperbarui.']);
    }

    public function updateLogo(Request $request)
    {   
        try
        {
            $file = $request->file('img_logo');
            // dd($file);
            $newName = 'logo.png';
            $file->move(public_path('img'), $newName);

            return response()->json(['status' => 'sukses', 'msg' => 'Logo Sekolah berhasil diupload.']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sekolah $sekolah)
    {
        //
    }
}
