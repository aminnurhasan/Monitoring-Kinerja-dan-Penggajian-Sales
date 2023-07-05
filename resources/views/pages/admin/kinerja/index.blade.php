@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Kinerja Sales</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('kinerja.index') }}">Kinerja</a></li>
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
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    Penjualan Seluruh Sales
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="penjualan"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    Sales Dengan Penjualan Terbanyak Bulan Ini
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-1">No</th>
                                            <th class="col-4">Nama Sales</th>
                                            <th class="col-3">Quantity</th>
                                            <th class="col-3">Omset</th>
                                        </tr>
                                    </thead>
                                        @foreach ($topSales as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->quantity }} Packs</td>
                                                <td>Rp. {{ number_format($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('kinerja.index') }}" method="get">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5 mt-2">
                                    <label style="font-size: 13pt">Nama Sales :</label>
                                </div>
                                <div class="col-sm-5">
                                    <select name="user_id" class="form-control" id="user_id">
                                            @foreach ($sales as $item)
                                                <option value="{{ $item->id }}" {{ $salesId == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="form-control btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Kinerja Sales
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="ion ion-clipboard mr-1"></i>
                                            Omset Penjualan
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
        
                                    <div class="card-body">
                                        <canvas id="penjualanPerSales"></canvas>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="ion ion-clipboard mr-1"></i>
                                            Jumlah Kunjungan Sales
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
        
                                    <div class="card-body">
                                        <canvas id="kunjungan"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

@endsection

@push('scripts')
{{-- <script>
    $(document).ready(function () {

        var ctx = document.getElementById('penjualanSales').getContext('2d');
        var chart = null;
        
        var labels =  {{ Js::from($labels) }};
        var data =  {{ Js::from($data) }};
        
        const config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantity Penjualan (Packs)',
                    borderColor: 'rgb(2, 187, 214)',
                    borderWidth: 2,
                    data: data,
                    tension: 0.1
                }]
            },
            options: {}
        };

        function updateChart() {
            if (chart) {
                chart.destroy();
            }

            chart = new Chart(ctx, config)
        }

        // $('#penjualanSales').change(function () {
        //     var user_id = $(this).val();

        //     $.ajax({
        //         url: '/penjualan-sales',
        //         method: 'GET',
        //         data: { user_id: user_id },
        //         success: function (response) {
        //             config.data.labels = response.labels;
        //             config.data.datasets[0].data = response.values;
        //             updateChart();
        //         }
        //     });
        // });

        updateChart();
    }); 
</script> --}}

{{-- Penjualan --}}
<script type="text/javascript">
  
    var labelsPen =  {{ Js::from($labelsPen) }};
    var dataPen =  {{ Js::from($dataPen) }};

    const dataPenjualan = {
    labels: labelsPen,
    datasets: [{
        label: 'Quantity Penjualan (Packs)',
    //   backgroundColor: 'rgb(129, 236, 252)',
        borderColor: 'rgb(2, 187, 214)',
        borderWidth: 2,
        data: dataPen,
        tension: 0.1
    }]
    };

    const configPenjualan = {
        type: 'line',
        data: dataPenjualan,
        options: {}
    };

    const penjualan = new Chart(
    document.getElementById('penjualan'),
    configPenjualan
    );
  
</script>

{{-- Per Sales --}}
<script type="text/javascript">
  
    var labelsPenSales =  {{ Js::from($labelsPenSales) }};
    var dataPenSales =  {{ Js::from($dataPenSales) }};

    const dataPenjualanSales = {
    labels: labelsPenSales,
    datasets: [{
        label: 'Total Omset',
        backgroundColor: 'rgb(129, 236, 252)',
        // backgroundColor: borderColorPenSales,
        borderColor: 'rgb(2, 187, 214)',
        // borderColor: backgroundColorPenSales,
        borderWidth: 2,
        data: dataPenSales,
        tension: 0.2
    }]
    };

    const configPenjualanSales = {
        type: 'line',
        data: dataPenjualanSales,
        options: {}
    };

    const penjualanSales = new Chart(
    document.getElementById('penjualanPerSales'),
    configPenjualanSales
    );
  
</script>

{{-- Kunjungan Per Sales --}}
<script type="text/javascript">
  
    var labelsKunjungan =  {{ Js::from($labelsKunjungan) }};
    var dataKunjungan =  {{ Js::from($dataKunjungan) }};

    const backgroundColorKunj = dataKunjungan.map(value => value < 10 ? 'rgb(214, 2, 9)' : 'rgb(129, 236, 252)' );
    // const borderColorKunj = dataKunjungan.map(value => value < 10 ?  'rgb(252, 3, 3)' : 'rgb(129, 236, 252)');

    const dataKunjunganSales = {
    labels: labelsKunjungan,
    datasets: [{
        label: 'Kunjungan',
        backgroundColor: backgroundColorKunj,
        // borderColor: borderColorKunj,
        borderWidth: 2,
        data: dataKunjungan,
        tension: 0.2
    }]
    };

    const configKunjungan = {
        type: 'bar',
        data: dataKunjunganSales,
        options: {}
    };

    const kunjunganSales = new Chart(
    document.getElementById('kunjungan'),
    configKunjungan
    );
  
</script>
@endpush