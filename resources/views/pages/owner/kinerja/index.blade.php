@extends('layouts.owner.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Kinerja Sales Manajer</h1>
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
                
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('input') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="">Bulan</label>
                                    <select name="bulan" class="form-control">
                                            <option name="bulan" value="01">Januari</option>
                                            <option name="bulan" value="02">Februari</option>
                                            <option name="bulan" value="03">Maret</option>
                                            <option name="bulan" value="04">April</option>
                                            <option name="bulan" value="05">Mei</option>
                                            <option name="bulan" value="06">Juni</option>
                                            <option name="bulan" value="07">Juli</option>
                                            <option name="bulan" value="08">Agustus</option>
                                            <option name="bulan" value="09">September</option>
                                            <option name="bulan" value="10">Oktober</option>
                                            <option name="bulan" value="11">November</option>
                                            <option name="bulan" value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="">Tahun</label>
                                    <input type="number" class="form-control" name="tahun" value="2023">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary form-control">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                @isset($click)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                List Kinerja Sales Manajer Pada {{$bln}}
                            </h3>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-1">No</th>
                                        <th class="col-1">Nama Toko</th>
                                        <th class="col-2">Alamat</th>
                                        <th class="col-1">Diaktifkan</th>
                                        <th class="col-1">Dinonaktifkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($click as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->namaToko }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->aktif }}</td>
                                            <td>{{ $item->nonaktif }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endisset
            </section>
        </div>
    </div>
</section>

@endsection

@push('scripts')
{{-- Penjualan --}}
{{-- <script type="text/javascript">
  
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
  
</script> --}}

{{-- Per Sales --}}
{{-- <script type="text/javascript">
  
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
  
</script> --}}

{{-- Kunjungan Per Sales --}}
{{-- <script type="text/javascript">
  
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
  
</script> --}}
@endpush