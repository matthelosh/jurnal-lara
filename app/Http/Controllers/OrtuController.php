<?php

namespace App\Http\Controllers;

use App\Ortu;
use Illuminate\Http\Request;

class OrtuController extends Controller
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
    public function create(Request $request)
    {
        // dd($request->input('nik_aktif'));
        try {
            Ortu::create([
                'nik'     => $request->input('nik_aktif'),
                'email'     => $request->input('email_aktif'),
                'hp'        => $request->input('hp_aktif'),
                'nama_ayah'     => $request->input('nama_ayah'),
                'job_ayah'     => $request->input('job_ayah'),
                'nama_ibu'     => $request->input('nama_ibu'),
                'job_ibu'     => $request->input('job_ibu'),
                'jl'        => $request->input('jl_ortu'),
                'desa'     => $request->input('desa_ortu'),
                'kec'     => $request->input('kec_ortu'),
                'kab'     => $request->input('kab_ortu'),
                'prov'     => $request->input('prov_ortu'),
                
                'nama_wali'     => $request->input('nama_wali'),
                'job_wali'     => $request->input('job_wali'),
                
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Data Ortu disimpan.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode().':'.$e->getMEssage()]);
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

    public function getOne(Request $request, $nik)
    {
        $msg = '';
        try {
            $ortu = Ortu::where('nik', $nik)->first();
            $msg = ( $ortu ) ? 'Data Ortu ditemukan.' : 'Data Ortu tidak ditemukan.';
            return response()->json(['status' => 'sukses', 'msg' => $msg, 'data' => $ortu ]);
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode() .': '. $e->getMessage()]);
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function show(Ortu $ortu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function edit(Ortu $ortu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            Ortu::where('id', $request->input('id_ortu'))->update([
                'nik'     => $request->input('nik_aktif'),
                'email'     => $request->input('email_aktif'),
                'hp'        => $request->input('hp_aktif'),
                'nama_ayah'     => $request->input('nama_ayah'),
                'job_ayah'     => $request->input('job_ayah'),
                'nama_ibu'     => $request->input('nama_ibu'),
                'job_ibu'     => $request->input('job_ibu'),
                'jl'     => $request->input('jl_ortu'),
                'desa'     => $request->input('desa_ortu'),
                'kec'     => $request->input('kec_ortu'),
                'kab'     => $request->input('kab_ortu'),
                'prov'     => $request->input('prov_ortu'),
                
                'nama_wali'     => $request->input('nama_wali'),
                'job_wali'     => $request->input('job_wali'),
            ]);
            return response()->json([ 'status' => 'sukses', 'msg' => 'Ortu diperbarui.' ]);
        } catch (\Exception $e) {
            return response()->json([ 'status' => 'gagal', 'msg' => $e->getCode().':'.$e->getMessage() ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ortu $ortu)
    {
        //
    }
}
