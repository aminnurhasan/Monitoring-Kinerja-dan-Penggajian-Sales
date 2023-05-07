<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;

class TokoController extends Controller
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
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;
        $toko = Toko::with('user');
        if(strlen($katakunci)){
            $toko = Toko::where('title', 'like', "%$katakunci%")
            ->orWhere('alamat', 'like', "%$katakunci%")
            ->orWhere('latitude', 'like', "%$katakunci%")
            ->orWhere('longitude', 'like', "%$katakunci%")
            ->orWhere('snippet', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else{
            $toko = Toko::orderBy('id', 'asc')->paginate($jumlahbaris);
        }
        return view('pages.toko.index', compact("toko"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        return view('pages.toko.create', compact('user'));
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
        // Toko::create($request->all());

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    // public function user(){
    //     $user = User::all();
    //     return view('pages.user.index', ['user' => $user]);
    // }

    // public function toko(){
    //     $toko = Toko::all();
    //     return view('pages.toko.index', ['toko' => $toko]);
    // }
}
