<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\Auth;
use App\Models\Transaksi;
use DB;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data = DB::table('transaksi')
            ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, SUM(quantity) AS totalQuantity"))
            ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->get();
        
        $chartData = [
            'bulan' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'totalQuantity' => []
        ];

        foreach ($data as $row){
            $chartData['totalQuantity'][] = $row->totalQuantity;
        }

        $request->merge(['chartData' => $chartData]);

        return $next($request);
    }
}
