<?php

namespace App\Http\Controllers;

use FontLib\Table\Table;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.data_user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_email = User::where('email', $request->input('email'))->get();
        if (count($user_email) > 0) {
            return redirect('/user/create')->with('error', 'Email yang anda masukan sudah terdaftar');
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->alamat = $request->input('alamat');
        $user->no_telepon = $request->input('no_telepon');
        $user->created_at = date('Y-m-d h:i:s');
        $user->updated_at = date('Y-m-d h:i:s');
        if ($request->hasFile('photo_profile')) {
            $path = Storage::putFile('public/photo_proifle', $request->file('photo_profile'));
            $file_url = Storage::url($path);
            $user->photo_profile = $file_url;
            $user->photo_profile_mime = $request->file('photo_profile')->getClientMimeType();
        }
        $save = $user->save();

        $user->roles()->attach($request->input('role'));

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }


    /**
     * Show user profile
     *
     * @param int $id
     * @return view of profile
     */
    public function profile($id)
    {
        $user = User::find($id);
        return view('pages.data_user.profile')->with('user', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.data_user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $user = User::find($id);

        if ($user->email != $request->input('email')) {
            $user_email = User::where('email', $request->input('email'))->get();
            if (count($user_email) > 0) {
                return redirect('/user/create')->with('error', 'Email yang anda masukan sudah terdaftar');
            }
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->alamat = $request->input('alamat');
        $user->no_telepon = $request->input('no_telepon');
        if ($request->hasFile('photo_profile')) {
            $path = Storage::putFile('public/photo_profile', $request->file('photo_profile'));
            $file_url = Storage::url($path);
            $user->photo_profile = $file_url;
            $user->photo_profile_mime = $request->file('photo_profile')->getClientMimeType();
        }
        $update = $user->save();
        if ($request->input('role') != NULL) {
            DB::table('role_users')
                ->where('user_id', $id)
                ->update(['role_id'=>$request->input('role')]);
        }

        return redirect('/user')->with('success', 'Data user berhasil diperbaharui');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$user = User::find($id);
        $user->delete();*/
        return redirect('/user')->with('success', 'Data user berhasil dihapus');
    }
}
