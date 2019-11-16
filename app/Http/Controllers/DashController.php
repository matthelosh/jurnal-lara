<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\User;

class DashController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('dash-admin.index', ['page' => 'dashboard']);
    }

    public function indexUsers()
    {
    	return view('dash-admin.index', ['page' => 'users']);
    }

    public function indexSiswa()
    {
        return view('dash-admin.index', ['page' => 'siswa']);
    }

    public function indexRombel()
    {
        return view('dash-admin.index', ['page' => 'rombel']);
    }

    public function indexMapel()
    {
        return view('dash-admin.index', ['page' => 'mapel']);
    }

    public function indexSetting()
    {
        return view('dash-admin.index', ['page' => 'pengaturan']);
    }
}
