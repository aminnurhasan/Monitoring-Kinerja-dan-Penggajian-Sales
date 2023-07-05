<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\MasterGaji;
use PDF;
use DB;
use Illuminate\Support\Carbon;

class AdminGajiController extends Controller
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
        return view('pages.admin.gaji.index', compact('gaji'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $gaji = Gaji::all();
        return view('pages.admin.gaji.create', compact('gaji'));
    }

    public function halCetakGaji()
    {
        return view('pages.admin.gaji.cetak');
    }

    public function cetakPDF(Request $request)
    {
        $inputBulan = $request->input('bulan');
        $inputTahun = $request->input('tahun');

        $gaji = DB::select(DB::raw('
            SELECT gaji.id AS id, user.name AS nama, gaji.gajiPokok AS gapok, gaji.intensifKunjungan AS insentif, gaji.bonusPenjualan AS bonus, gaji.denda AS denda, gaji.gajiTotal AS total
            FROM gaji
            JOIN user ON gaji.user_id = user.id
            WHERE gaji.bulan = :inputBulan
            AND gaji.tahun = :inputTahun
            GROUP BY id, nama, gapok, insentif, bonus, denda, total
        '), ['inputBulan' => $inputBulan, 'inputTahun' => $inputTahun]);

        if ($inputBulan == 1){
            $bulan = 'Laporan Gaji Sales Bulan Januari';
        } else if($inputBulan == 2){
            $bulan = 'Laporan Gaji Sales Bulan Februari';
        } else if($inputBulan == 3){
            $bulan = 'Laporan Gaji Sales Bulan Maret';
        } else if($inputBulan == 4){
            $bulan = 'Laporan Gaji Sales Bulan April';
        } else if($inputBulan == 5){
            $bulan = 'Laporan Gaji Sales Bulan Mei';
        } else if($inputBulan == 6){
            $bulan = 'Laporan Gaji Sales Bulan Juni';
        } else if($inputBulan == 7){
            $bulan = 'Laporan Gaji Sales Bulan Juli';
        } else if($inputBulan == 8){
            $bulan = 'Laporan Gaji Sales Bulan Agustus';
        } else if($inputBulan == 9){
            $bulan = 'Laporan Gaji Sales Bulan September';
        } else if($inputBulan == 10){
            $bulan = 'Laporan Gaji Sales Bulan Oktober';
        } else if($inputBulan == 11){
            $bulan = 'Laporan Gaji Sales Bulan November';
        } else{
            $bulan = 'Laporan Gaji Sales Bulan Desember';
        }

        $data = [
            'title' => $bulan,
            'items' => $gaji,
        ];

        $pdf = PDF::loadView('pages.admin.gaji.template', $data);

        return redirect('/gaji');        
        return $pdf->stream('Rekap Gaji Bulanan.pdf');
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

        $master = DB::select(DB::raw('
            SELECT gapok, insentifKunjungan, bonusPenjualan, denda
            FROM master_gaji
            WHERE id = 1
        '));

        $gapok = $master[0]->gapok;
        $insentif = $master[0]->insentifKunjungan;
        $bonus = $master[0]->bonusPenjualan;
        $denda = $master[0]->denda;

        // dd($gapok, $insentif, $bonus, $denda);
        
        $totalGaji = DB::select(DB::raw('
            SELECT id_user, nama, gapok, intensifKunjungan, bonusPenjualan, denda, SUM(gapok + intensifKunjungan + bonusPenjualan - denda) as totalGaji
            FROM (
                SELECT user.id AS id_user, user.name AS nama, ? AS gapok, COUNT(transaksi.user_id) * ? AS intensifKunjungan, 	
                SUM(transaksi.totalPrice) * ? AS bonusPenjualan,
                CASE
                	WHEN COUNT(transaksi.user_id) = 9 THEN (? * 1)
                	WHEN COUNT(transaksi.user_id) = 8 THEN (? * 2)
                	WHEN COUNT(transaksi.user_id) = 7 THEN (? * 3)
                	WHEN COUNT(transaksi.user_id) = 6 THEN (? * 4)
                	WHEN COUNT(transaksi.user_id) = 5 THEN (? * 5)
                	WHEN COUNT(transaksi.user_id) = 4 THEN (? * 6)
                	WHEN COUNT(transaksi.user_id) = 3 THEN (? * 7)
                	WHEN COUNT(transaksi.user_id) = 2 THEN (? * 8)
                	WHEN COUNT(transaksi.user_id) = 1 THEN (? * 9)
                	ELSE 0
                END AS denda
                FROM user
                JOIN transaksi ON user.id = transaksi.user_id
                WHERE user.role = 0
                AND EXTRACT(MONTH FROM transaksi.waktu) = ?
                AND EXTRACT(YEAR FROM transaksi.waktu) = ?
                GROUP BY user.id, user.name
            )as subquery
            GROUP BY id_user, nama, intensifKunjungan, bonusPenjualan, gapok, denda
        '), [$gapok, $insentif, $bonus, $denda, $denda, $denda, $denda, $denda, $denda, $denda, $denda, $denda, $inputBulan, $inputTahun]);

        // Add Gaji User ke Database
        foreach($totalGaji as $gajiSales){
                Gaji::create([
                    'user_id' => $gajiSales->id_user,
                    'gajiPokok' => $gajiSales->gapok,
                    'intensifKunjungan' => $gajiSales->intensifKunjungan,
                    'bonusPenjualan' => $gajiSales->bonusPenjualan,
                    'denda' => $gajiSales->denda,
                    'gajiTotal' => $gajiSales->totalGaji,
                    'bulan' => $inputBulan,
                    'tahun' => $inputTahun
                ]);
        }
        return redirect()->route('gaji.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gaji = Gaji::findOrFail($id);
        return view('pages.admin.gaji.show', compact('gaji'));
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
