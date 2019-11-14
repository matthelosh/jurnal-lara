<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Datatables::of(User::all())->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try
        {
            User::create([
                'nip' => $request->input('txt-nip'),
                'username' => $request->input('txt-username'),
                'password' => $request->input('txt-password'),
                'fullname' => $request->input('txt-fullname'),
                'email'    => $request->input('txt-email'),
                'hp'       => $request->input('txt-hp'),
                'level'    => $request->input('txt-level')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Pengguna baru tersimpan']);
        }
        catch(\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('fileUser');
        try {
            Excel::import(new UsersImport, $file);
            $file->store('files');
            
            return response()->json(['status' => 'sukses', 'msg' => 'Data User']);
        }
        catch(\Exception $e)
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            if ($request->input('txt-password') == '') {
                User::find($id)->update([
                    'nip' => $request->input('txt-nip'),
                    'username' => $request->input('txt-username'),
                    'fullname' => $request->input('txt-fullname'),
                    'hp' => $request->input('txt-hp'),
                    'email' => $request->input('txt-email'),
                    'level' => $request->input('txt-level')
                ]);
            } else {
                User::find($id)->update([
                    'nip' => $request->input('txt-nip'),
                    'username' => $request->input('txt-username'),
                    'password' => Hash::make($request->input('txt-password')),
                    'fullname' => $request->input('txt-fullname'),
                    'hp' => $request->input('txt-hp'),
                    'email' => $request->input('txt-email'),
                    'level' => $request->input('txt-level')
                ]);
            }
            return response()->json(['status' => 'sukses', 'msg' => 'Data Pengguna '.$id.' berhasil diperbarui.']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $nip)
    {
        try {
            User::where('nip', $nip)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Pengguna dengan NIP '.$nip.' telah dihapus']);
        } catch (Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => 'Gagal: '+$e->getMessage()]);
        }
    }
}
