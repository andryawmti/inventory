<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaturan;

class PengaturanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengaturan = Pengaturan::find(1);
        return view('pages.pengaturan_sistem.settings')->with(array('pengaturan'=>$pengaturan));
    }

    public function simpanPerubahan(Request $request){
        $pengaturan = Pengaturan::find(1);
        $pengaturan->nama_perusahaan = $request->input('nama_perusahaan');
        $pengaturan->nama_sistem = $request->input('nama_sistem');
        $pengaturan->alamat_perusahaan = $request->input('alamat_perusahaan');
        $pengaturan->no_telepon = $request->input('no_telepon');
        $pengaturan->keterangan = $request->input('keterangan');
        $update = $pengaturan->save();

        return redirect(route('pengaturan'))->with('success', 'Pengaturan sistem berhasil diperbaharui');
    }
}
