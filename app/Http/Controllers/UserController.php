<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

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
        return Datatables::of(User::where('level', '!=', 'admin'))->addIndexColumn()->addColumn('qr', function($user) {
            return QrCode::size(50)->generate('/dashboard/users/detail/'.$user->username);
        })->rawColumns(['qr'])->make(true);
    }

    public function select(Request $request)
    {
        $search = $request->input('q');

        if ($search == '') {
            $gurus = User::where('level', 'guru')->select('nip', 'fullname')->get();
        } else {
            $gurus = User::where('level', 'guru')->select('nip', 'fullname')->where('fullname', 'like', '%'.$search.'%')->get();
        }

        $response = [];
        foreach($gurus as $guru)
        {
            array_push($response, ["id" =>$guru->nip,"text" => $guru->fullname]);
        }

        return response()->json($response);
    }
    public function selectStafs(Request $request)
    {
        $search = $request->input('q');

        if ($search == '') {
            $gurus = User::where('level', 'staf')->select('nip', 'fullname')->get();
        } else {
            $gurus = User::where('level', 'staf')->select('nip', 'fullname')->where('fullname', 'like', '%'.$search.'%')->get();
        }

        $response = [];
        foreach($gurus as $guru)
        {
            array_push($response, ["id" =>$guru->nip,"text" => $guru->fullname]);
        }

        return response()->json($response);
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
                'password' => Hash::make($request->input('txt-password')),
                'fullname' => $request->input('txt-fullname'),
                'jk'       => $request->input('jk'),
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
            
            return back()->with(['status' => 'sukses', 'msg' => 'data pengguna baru telah tersimpan.']);
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
                    'jk' => $request->input('jk'),
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
        } catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => 'Gagal: '+$e->getMessage()]);
        }
    }
    public function updateFoto(Request $request)
    {   
        try
        {
            $file = $request->file('img_foto');
            // dd($file);
            $newName = $request->user()->nip.'.jpg';
            $file->move(public_path('img/faces'), $newName);

            return response()->json(['status' => 'sukses', 'msg' => 'Foto Profil berhasil diupload.']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    public function getStafs(Request $request)
    {
        $stafs = 'App\User'::where('level', 'staf')->get();

        return DataTables::of($stafs)->addIndexColumn()->make(true);
    }
}
