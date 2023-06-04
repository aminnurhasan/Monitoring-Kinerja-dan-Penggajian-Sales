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
        // if($gaji->bulan == 1){
        //     $bulanGaji = 'Januari';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 2){
        //     $bulanGaji = 'Februari';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 3){
        //     $bulanGaji = 'Maret';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 4){
        //     $bulanGaji = 'April';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 5){
        //     $bulanGaji = 'Mei';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 6){
        //     $bulanGaji = 'Juni';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 7){
        //     $bulanGaji = 'Juli';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 8){
        //     $bulanGaji = 'Agustus';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 9){
        //     $bulanGaji = 'September';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 10){
        //     $bulanGaji = 'Oktober';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 11){
        //     $bulanGaji = 'November';
        //     return $bulanGaji;
        // }else if($gaji->bulan == 12){
        //     $bulanGaji = 'Desember';
        //     return $bulanGaji;
        // }

        // $gajiPokok = DB::table('user')
        //     ->select('id', 'name', 'gajiPokok')
        //     ->where('is_admin', 0)
        //     ->get();

        // Jumlah Kunjungan Sales Perbulan
        // $kunjunganSales = DB::table('transaksi')
        //     ->select('user.id', 'user.name', DB::raw('COUNT(*) as kunjungan'))
        //     ->join('user', 'transaksi.user_id', '=', 'user.id')
        //     ->whereMonth('waktu', $inputBulan)
        //     ->whereYear('waktu', $inputTahun)
        //     ->groupBy('user.id', 'user.name')
        //     ->get();

        // Total Quantity dan Total Penjualan Sales Perbulan
        // $penjualanSales = DB::table('transaksi')
        //     ->select('user.id', 'user.name', DB::raw('SUM(transaksi.quantity) as totalQuantity'), DB::raw('SUM(transaksi.totalPrice) as totalPenjualan'))
        //     ->join('user', 'transaksi.user_id', '=', 'user.id')
        //     ->whereMonth('waktu', $inputBulan)
        //     ->whereYear('waktu', $inputTahun)
        //     ->groupBy('user.id', 'user.name')
        //     ->get();
            
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

        // // Query Gaji Pokok Sales
        // $gajiPokokSales = DB::select(DB::raw('
        //     SELECT id as id_sales, name as nama, gajiPokok as gapok
        //     FROM user
        //     WHERE is_admin = 0
        // '));

        // // Query Kunjungan Sales Perbulan
        // $kunjunganSales = DB::select(DB::raw('
        //     SELECT user.id as id_sales, user.name AS nama, COUNT(*) AS kunjungan
        //     FROM user
        //     JOIN transaksi ON user.id = transaksi.user_id
        //     WHERE EXTRACT(MONTH FROM transaksi.waktu) = :inputBulan
        //     AND EXTRACT(YEAR FROM transaksi.waktu) = :inputTahun
        //     GROUP BY user.id, user.name
        // '), ['inputBulan' => $inputBulan, 'inputTahun' => $inputTahun]);

        // //Query Total Quantity dan Total Penjualan Sales Perbulan
        // $penjualanSales = DB::select(DB::raw('
        //     SELECT user.id as id_sales, user.name as nama, SUM(transaksi.quantity) AS totalQuantity, SUM(transaksi.totalPrice) AS totalPenjualan
        //     FROM user
        //     JOIN transaksi ON user.id = transaksi.user_id
        //     WHERE EXTRACT(MONTH FROM transaksi.waktu) = :inputBulan
        //     AND EXTRACT(YEAR FROM transaksi.waktu) = :inputTahun
        //     GROUP BY user.id, user.name
        // '), ['inputBulan' => 5, 'inputTahun' => 2023]);

        // $gaji = DB::select(DB::raw('
        //     SELECT u.id as id_user, u.name as nama, u.gajiPokok, COUNT(t.user_id) * 10000 as insentifKunjungan, 
        // '));

        // $bonusKunjungan = [];
        // $totalQuantity = [];
        // $bonusPenjualan = [];
        // foreach ($kunjunganSales as $kunjungan){
        //     $bonusKunjungan[$kunjungan->id_sales] = $kunjungan->kunjungan * $bonusPerKunjungan;
        // }

        // foreach ($penjualanSales as $penjualan){
        //     $totalQuantity[$penjualan->id_sales] = $penjualan->totalQuantity;
        //     $bonusPenjualan[$penjualan->id_sales] = $penjualan->totalPenjualan * 0.5;
        // }

        // foreach ($gajiPokokSales as $gaji){
        //     // $idSales = $gaji->id_sales;
        //     $nama = $gaji->nama;
        //     $gajiPokok = $gaji->gapok;
        //     // $jumlahKunjungan = $totalKunjungan;
        //     $bonusKunjungan = $bonusKunjungan;
        //     $jumlahQuantity = $totalQuantity;
        //     // $jumlahPenjualan = $totalPenjualan;
        //     $bonuPenjualan = $bonusPenjualan;
        //     // $gajiTotal = $gajiPokok + $bonusKunjungan + $bonuPenjualan;

        //     // $hasilAkhir[] = $hasil;
            
        // }

        // foreach ($gajiPokokSales as $gaji){
        //     $hasil = [
        //         'idSales' => $gaji->id_sales,
        //         'nama' => $gaji->nama,
        //         'gajiPokok' => $gaji->gapok,
        //         'jumlahKunjungan' => $totalKunjungan,
        //         'bonusKunjungan' => $totalKunjungan * $bonusPerKunjungan,
        //         'jumlahQuantity' => $totalQuantity,
        //         'jumlahPenjualan' => $totalPenjualan,
        //         'bonuPenjualan' => $totalPenjualan * 0.05,
        //         'gajiTotal' => $gajiPokok + $bonusKunjungan + $bonuPenjualan
        //     ];

        //     $hasilAkhir[] = $hasil;
            
        // }
        // dd($totalGaji);

        return view('pages.gaji.create', ['totalGaji' => $totalGaji], compact('gaji'));
        // $user = User::all();
        // $tanggalAwal = $request->input('tanggalAwal');
        // $tanggalAkhir = $request->input('tanggalAkhir');
        // $gajiPokok = $request->input('gajiPokok');
        // $bonusKunjungan = $request->input('bonusKunjungan');

        // $idSales = $request->input('user_id');

        // $namaSales = DB::table('user')
        //     ->join('transaksi', 'user.id', '=', 'transaksi.user_id')
        //     ->select('user.name as nama')
        //     ->where('user.id', '=', $idSales)
        //     ->get();

        // // Query Total Quantity dan Total Penjualan Sales
        // $totalPenjualan = DB::table('transaksi')
        //     ->select('salesName as nama', DB::raw('SUM(quantity) as totalQuantity'), DB::raw('SUM(totalPrice) as totalPenjualan'))
        //     ->where('user_id', '=', $idSales)
        //     ->whereBetween('waktu', [$tanggalAwal, $tanggalAkhir])
        //     ->groupBy('salesName')
        //     ->get();
        
        // // Query Total Kunjungan Sales
        // $totalKunjungan = DB::table('transaksi')
        //     ->select(DB::raw('COUNT(*) as kunjungan'))
        //     ->where('user_id', '=', $idSales)
        //     ->get();

        // $nama = "";
        // foreach ($namaSales as $namaSales){
        //     $nama = $namaSales->nama;
        // }

        // // Perhitungan Total Insentif Kunjungan Sales
        // $insentifKunjungan = 0;
        // foreach ($totalKunjungan as $kunjungan){
        //     $insentifKunjungan += $kunjungan->kunjungan;
        // }
        
        // $totalInsentifKunjungan = $insentifKunjungan * $bonusKunjungan;

        // // Perhitungan Bonus Penjualan Sales
        // $penjualanSales = 0;
        // $quantitySales = 0;
        // foreach ($totalPenjualan as $penjualan){
        //     $penjualanSales += $penjualan->totalPenjualan;
        //     $quantitySales += $penjualan->totalQuantity;
        // }

        // $bonusPenjualan = 0.05 * $penjualanSales;

        // // Perhitungan Total Gaji Sales
        // $totalGaji = $gajiPokok + $totalInsentifKunjungan + $bonusPenjualan;
        // compact('user', 'nama', 'bulan', 'penjualanSales', 'gajiPokok', 'tanggalAwal', 'tanggalAkhir', 'quantitySales', 'totalKunjungan', 'totalInsentifKunjungan', 'bonusPenjualan', 'totalGaji')
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
