<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;
use DB;

class AdminTokoController extends Controller
{
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
        $toko = Toko::all();
        return view('pages.admin.toko.index', compact("toko"));
    }

    public function status($id)
    {
        $toko = Toko::findOrFail($id);
        $statusGet = $toko->status;
        // dd($toko);
        if($statusGet == 0) {
            $toko->update(['status' => 1]);
            return redirect()->route('toko.index');
        }else{
            $toko->update(['status' => 0]);
            return redirect()->route('toko.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = DB::select(DB::raw('
            SELECT id, name, email, role
            FROM user
            WHERE role = 0
        '));
        return view('pages.admin.toko.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'snippet' => 'required',
        ],[
            'user_id.required' => 'Nama User Wajib Diisi',
            'title.required' => 'Nama Toko Wajib Diisi',
            'alamat.required' => 'Alamat Toko Wajib Diisi',
            'latitude.required' => 'Latitude Wajib Diisi',
            'longitude.required' => 'Longitude Wajib Diisi',
            'snippet.required' => 'Snippet Wajib Diisi'
        ]);

        $toko = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'snippet' => $request->snippet,
        ];
        Toko::create($toko);
        return redirect()->route('toko.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toko = Toko::findOrFail($id);
        return view('pages.admin.toko.show', compact('toko'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toko = Toko::findOrFail($id);
        $user = DB::select(DB::raw('
            SELECT id, name, email, role
            FROM user
            WHERE role = 0
        '));
        return view('pages.admin.toko.edit', compact('toko', 'user'));
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
        $toko = Toko::findOrFail($id);

        $toko->update($request->all());

        return redirect()->route('toko.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $toko = Toko::find($id);
        $toko->delete();
        return redirect()->route('toko.index');
    }    
}
