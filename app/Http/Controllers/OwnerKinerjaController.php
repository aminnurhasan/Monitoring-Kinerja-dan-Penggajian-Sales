<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Toko;
use App\Http\Models\Click;
use DB;

class OwnerKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.owner.kinerja.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function input(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $click = DB::select(DB::raw('
            SELECT click.id AS id, toko.title AS namaToko, toko.alamat AS alamat, click.klikAktif AS aktif, click.KlikNonaktif AS nonaktif, click.bulan
            FROM toko
            JOIN click ON toko.id = click.toko_id
            WHERE SUBSTRING(bulan, 1, 4) = :tahun
            AND SUBSTRING(bulan, 6) = :bulan
            GROUP BY id, namaToko, alamat, klikAktif, klikNonaktif, bulan
        '), ['bulan' => $bulan, 'tahun' => $tahun]);

        if($bulan == 01){
            $bb = 'Januari';
        }elseif($bulan == 02){
            $bb = 'Februari';
        }elseif($bulan == 03){
            $bb = 'Maret';
        }elseif($bulan == 04){
            $bb = 'April';
        }elseif($bulan == 05){
            $bb = 'Mei';
        }elseif($bulan == 06){
            $bb = 'Juni';
        }elseif($bulan == 07){
            $bb = 'Juli';
        }elseif($bulan == '08'){
            $bb = 'Agustus';
        }elseif($bulan == '09'){
            $bb = 'September';
        }elseif($bulan == 10){
            $bb = 'Oktober';
        }elseif($bulan == 11){
            $bb = 'November';
        }else{
            $bb = 'Desember';
        }

        $bln = "Bulan ". $bb. " Tahun ". $tahun;

        return view('pages.owner.kinerja.index', compact('click', 'bln'));
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
        //
    }
}
