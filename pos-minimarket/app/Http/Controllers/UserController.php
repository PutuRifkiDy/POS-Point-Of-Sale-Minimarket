<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    //
    public function index()
    {
        //
        return view("user.index");
    }

    /**
     * Show the form for creating a new resource.
     */

     public function data(){
        $user = User::orderBy("id", "desc")->get();
        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user){
                if($user->email === "adminSuper@gmail.com"){
                    return '';
                }
            return '<button type="button" onclick="editForm(`'. route('user.update', $user->id) .'`)" class="btn btn-info btn-flat"><i class="fa fa-edit"></i></button> <button type="button" onclick="deleteData(`'.route('user.destroy', $user->id).'`)" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
        })->rawColumns(['aksi'])->make(true);
     }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = $request->level;
        $user->foto = '/img/profile.png';
        $user->save();
        return response()->json("Data berhasil dimasukkan", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);

        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->has('password') && $request->password != ""){
            $user->password = bcrypt($request->password);
        }
        $user->level = $request->level;
        $user->save();
        return response()->json('Data Berhasil disimpan', 200);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);
        $user->delete();

        return response()->json(null, 204);
    }

    public function profil(){
        $profil = auth()->user();
        return view('user.profil', compact('profil'));
    }

    public function updateProfil(Request $request){
        $user = auth()->user();

        $user->name = $request->name;
        if($request->has('password') && $request->password != ""){
            if(Hash::check($request->old_password, $user->password)){
                if($request->password == $request->password_confirmation){
                    $user->password = bcrypt($request->password);
                } else {
                    return response()->json('Konfirmasi Password Tidak Sesuai', 422);
                }
            } else {
                return response()->json('Password Lama Tidak Sesuai', 422);
            }
        }

        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $nama = 'logo-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $user->foto = "/img/$nama";
        }

        $user->update();

        return response()->json($user, 200);
    }
}
