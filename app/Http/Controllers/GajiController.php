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
        return view('pages.gaji.index', compact('gaji'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $gaji = Gaji::all();
        return view('pages.gaji.create', compact('gaji'));
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

        // Query Menghitung Gaji Sales
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

        // Add Gaji User ke Database
        foreach($totalGaji as $gajiSales){
                Gaji::create([
                    'user_id' => $gajiSales->id_user,
                    'gajiPokok' => $gajiSales->gapok,
                    'insentifKunjungan' => $gajiSales->insentifKunjungan,
                    'bonusPenjualan' => $gajiSales->bonusPenjualan,
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
        return view('pages.gaji.show', compact('gaji'));
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
