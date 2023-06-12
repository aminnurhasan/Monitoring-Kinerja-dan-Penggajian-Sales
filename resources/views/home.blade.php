@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4><b>{{ $sales }}</b></h4>
                                <p>Total Sales</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4><b>{{ $toko }}</b></h4>
                                <p>Total Toko</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-store"></i>
                            </div>
                            <a href="{{ route('toko.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4><b>{{ $penjualan }} Packs</b></h4>
                                <p>Total Penjualan Bulan Ini</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('transaksi.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4><b>Rp. {{ number_format($pendapatan) }}</b></h4>
                                <p>Total Pendapatan Bulan Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <a href="{{ route('transaksi.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Grafik Penjualan Produk 12 Bulan Terakhir
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="100px"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
  
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};

    const data = {
    labels: labels,
    datasets: [{
        label: 'Quantity Penjualan (Packs)',
    //   backgroundColor: 'rgb(129, 236, 252)',
        borderColor: 'rgb(2, 187, 214)',
        borderWidth: 2,
        data: users,
        tension: 0.1
    }]
    };

    const config = {
    type: 'line',
    data: data,
    options: {}
    };

    const myChart = new Chart(
    document.getElementById('myChart'),
    config
    );
  
</script>
@endpush
