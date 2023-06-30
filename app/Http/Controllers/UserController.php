<?php

namespace App\Http\Controllers;

use App\Traits\ImageStorage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    use ImageStorage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        // $user = User::select(where);
        $user = DB::select(DB::raw('
            SELECT id, name, email, jenisKelamin, tglLahir, alamat, status
            FROM user
            WHERE role = 0
        '));
        return view('pages.user.index', compact("user"));
    }

    public function status($id)
    {
        $user = User::findOrFail($id);
        $statusGet = $user->status;
        // dd($user);
        if($statusGet == 0) {
            $user->update(['status' => 1]);
            return redirect()->route('user.index');
        }else{
            $user->update(['status' => 0]);
            return redirect()->route('user.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        return view('pages.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = 0;
        $foto = $request->file('foto');

        $user = [
            'name' => $request->name,
            'jenisKelamin' => $request->jenisKelamin,
            'alamat' => $request->alamat,
            'tglLahir' => $request->tglLahir,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gajiPokok' => $request->gajiPokok,
            'foto' => $this->uploadImage($foto, $request->name, 'profile'),
            'role' => $role
        ];

        User::create($user);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
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
        $user = User::findOrFail($id);

        $foto = $request->file('foto');

        $update = [
            'name' => $request->name,
            'jenisKelamin' => $request->jenisKelamin,
            'alamat' => $request->alamat,
            'tglLahir' => $request->tglLahir,
            'email' => $request->email,
            'gajiPokok' => $request->gajiPokok,
            'foto' => $this->uploadImage($foto, $request->name, 'profile', true, $user->foto),
        ];

        $user->update($update);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);        

        $user->delete();

        return redirect()->route('user.index');
    }
}
