<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterGaji;
use DB;

class OwnerMasterGajiController extends Controller
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

    public function index()
    {
        $master = MasterGaji::all();

        return view('pages.owner.masterGaji.index', compact('master'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $master = MasterGaji::findOrFail($id);
        return view('pages.owner.masterGaji.edit', compact('master'));
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
        $master = MasterGaji::findOrFail($id);

        $update = [
            'gapok' => $request->gapok,
            'insentifKunjungan' => $request->insentifKunjungan,
            'bonusPenjualan' => $request->bonusPenjualan/100,
            'denda' => $request->denda
        ];

        $master->update($update);
        return redirect()->route('master.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
