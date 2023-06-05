<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\User;
use App\Models\Transaksi;
use DB;
use Illuminate\Support\Carbon;

class GajiController extends Controller
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
        $gaji = Gaji::all();

        $bulanGaji = '';
            
        return view('pages.gaji.index', compact('gaji'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $inputBulan;
    private $inputTahun;

    public function create(Request $request)
    {
        $gaji = Gaji::all();
        $this->inputBulan = $request->input('bulan');
        $this->inputTahun = $request->input('tahun');

        $totalGaji = DB::select(DB::raw('
            SELECT id_user, nama, gapok, insentifKunjungan, bonusPenjualan, SUM(gapok + insentifKunjungan + bonusPenjualan) as totalGaji
            FROM (
                SELECT user.id AS id_user, user.name AS nama, user.gajiPokok AS gapok, COUNT(transaksi.user_id) * 10000 AS insentifKunjungan, 	
                SUM(transaksi.totalPrice) * 0.05 AS bonusPenjualan
                FROM user
                JOIN transaksi ON user.id = transaksi.user_id
                WHERE user.is_admin = 0
                AND EXTRACT(MONTH FROM transaksi.waktu) = :inputBulan
                AND EXTRACT(YEAR FROM transaksi.waktu) = :inputTahun
                GROUP BY user.id, user.name, user.gajiPokok
            )as subquery
            GROUP BY id_user, nama, insentifKunjungan, bonusPenjualan, gapok
        '), ['inputBulan' => $this->inputBulan, 'inputTahun' => $this->inputTahun]);

        return view('pages.gaji.create', ['totalGaji' => $totalGaji], compact('gaji'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gaji = Gaji::all();
        $inputBulan = $request->input('bulan');
        $inputTahun = $request->input('tahun');

        $totalGaji = DB::select(DB::raw('
            SELECT id_user, nama, gapok, insentifKunjungan, bonusPenjualan, SUM(gapok + insentifKunjungan + bonusPenjualan) as totalGaji
            FROM (
                SELECT user.id AS id_user, user.name AS nama, user.gajiPokok AS gapok, COUNT(transaksi.user_id) * 10000 AS insentifKunjungan, 	
                SUM(transaksi.totalPrice) * 0.05 AS bonusPenjualan
                FROM user
                JOIN transaksi ON user.id = transaksi.user_id
                WHERE user.is_admin = 0
                AND EXTRACT(MONTH FROM transaksi.waktu) = :inputBulan
                AND EXTRACT(YEAR FROM transaksi.waktu) = :inputTahun
                GROUP BY user.id, user.name, user.gajiPokok
            )as subquery
            GROUP BY id_user, nama, insentifKunjungan, bonusPenjualan, gapok
        '), ['inputBulan' => $inputBulan, 'inputTahun' => $inputTahun]);

        $bulan = $inputBulan;
        if($inputBulan == 1 ){
            $bulan = 'Januari';
            return $bulan;
        }else if($inputBulan == 2){
            $bulan = 'Februari';
            return $bulan;
        }else if($inputBulan == 3){
            $bulan = 'Maret';
            return $bulan;
        }else if($inputBulan == 4){
            $bulan = 'April';
            return $bulan;
        }else if($inputBulan == 5){
            $bulan = 'Mei';
            return $bulan;
        }else if($inputBulan == 6){
            $bulan = 'Juni';
            return $bulan;
        }else if($inputBulan == 7){
            $bulan = 'Juli';
            return $bulan;
        }else if($inputBulan == 8){
            $bulan = 'Agustus';
            return $bulan;
        }else if($inputBulan == 9){
            $bulan = 'September';
            return $bulan;
        }else if($inputBulan == 10){
            $bulan = 'Oktober';
            return $bulan;
        }else if($inputBulan == 11){
            $bulan = 'November';
            return $bulan;
        }else if($inputBulan == 12){
            $bulan = 'Desember';
            return $bulan;
        };

        foreach($totalGaji as $gaji){
            foreach($bulan as $bulan){
                Gaji::create([
                    'user_id' => $gaji->id_user,
                    'gajiPokok' => $gaji->gapok,
                    'insentifKunjungan' => $gaji->insentifKunjungan,
                    'bonusPenjualan' => $gaji->bonusPenjualan,
                    'gajiTotal' => $gaji->totalGaji,
                    'bulan' => $bulan,
                    'tahun' => $inputTahun
                ]);
            }
                
        }
        dd($totalGaji);
        return view('pages.gaji.index', ['totalGaji' => $totalGaji], compact('gaji'));
        
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
