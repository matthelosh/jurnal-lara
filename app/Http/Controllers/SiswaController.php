<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Imports\SiswasImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Datatables::of(Siswa::all())->addIndexColumn()->make(true);
    }

    public function import(Request $request)
    {
        $file = $request->file('fileSiswa');
        try {
            Excel::import(new SiswasImport, $file);
            $file->store('files');

            return redirect('/dashboard/siswa')->with(['status' => 'sukses', 'msg' => 'Data Siswa berhasil diimport']);
        } catch (\Illuminate\Database\QueryException $e) {
            // dd($e->getCode());
            if ($e->getCode() == '23000')
            return back()->with(['status' => 'gagal', 'msg' => 'Mohon Dicek lagi. Ada siswa dengan nis/nisn yang sama sudah ada dalam basis data.']);
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
            Siswa::create([
                'nis' => $request->input('nis'),
                'nisn' => $request->input('nisn'),
                'nama_siswa' => $request->input('nama_siswa'),
                'jk' => $request->input('jk'),
                'rombel_id' => $request->input('rombel_id')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Data Siswa: '.$request->input('nama_siswa'). ' tersimpan']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return response()->json(['status' => 'gagal', 'msg' => 'NIS / NISN sudah digunakan untuk siswa lain.']);
            }
        }
    }

    public function getMembers(Request $request, $rombel_id)
    {
        $siswas = Siswa::where('rombel_id', $rombel_id)->get();
        return Datatables::of($siswas)->addIndexColumn()->make(true);
    }

    public function getNonMembers(Request $request)
    {
        $nonmembers = Siswa::where('rombel_id', '0')->get();

        return Datatables::of($nonmembers)->addIndexColumn()->make(true);
    }

    // Pindah Rombel
    public function pindahRombel(Request $request)
    {
        $tujuan = $request->input('tujuan');
        $nisns = $request->input('nisns');

        try {
            foreach ($nisns as $nisn) {
                Siswa::where('nisn', $nisn)->update(['rombel_id' => $tujuan]);
            }
        
            return response()->json(['status' => 'sukses', 'msg' => 'Siswa-siswa tersebut telah dipindah ke rombel tujuan']);
        }
        catch(\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }
    // Masukkan Siswa ke romcwl
    public function masukkanSiswa(Request $request)
    {
        $tujuan = $request->input('tujuan');
        $nisns = $request->input('nisns');

        try {
            foreach ($nisns as $nisn) {
                Siswa::where('nisn', $nisn)->update(['rombel_id' => $tujuan]);
            }
        
            return response()->json(['status' => 'sukses', 'msg' => 'Siswa-siswa tersebut telah dimasukkan ke rombel ini.']);
        }
        catch(\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    // Keluarkan siswa dari rombel
    public function keluarRombel(Request $request)
    {
        $nisns = $request->input('nisns');
        try {
            foreach ($nisns as $nisn) {
                Siswa::where('nisn', $nisn)->update(['rombel_id' => '0']);
            }

            return response()->json(['status' => 'sukses', 'msg' => 'Siswa-siswa tersebut telah dikeluarkan dari rombel ini.']);
        } catch (\Exception $e) {
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
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_siswa)
    {
        //
        try {
            Siswa::find($id_siswa)->update([
                'nis' => $request->input('nis'),
                'nisn' => $request->input('nisn'),
                'nama_siswa' => $request->input('nama_siswa'),
                'jk' => $request->input('jk'),
                'rombel_id' => $request->input('rombel_id'),
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Data Siswa: '.$request->input('nama_siswa'). 'telah diperbarui.']);
        }
        catch(\Exception $e){
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
        catch(Illuminate\Database\QueryException $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $siswa)
    {
        //
        try {
            Siswa::where('nisn', $siswa)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Siswa dengan NISN: '.$siswa .' telah dihapus.']);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }
}
