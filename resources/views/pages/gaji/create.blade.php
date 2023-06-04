@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Generate Gaji Bulanan Sales
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('gaji.create') }}" method="get" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="">Bulan</label>
                                    <select name="bulan" class="form-control">
                                        {{-- @foreach ($bulan as $item) --}}
                                            <option name="bulan" value="1">Januari</option>
                                            <option name="bulan" value="2">Februari</option>
                                            <option name="bulan" value="3">Maret</option>
                                            <option name="bulan" value="4">April</option>
                                            <option name="bulan" value="5">Mei</option>
                                            <option name="bulan" value="6">Juni</option>
                                            <option name="bulan" value="7">Juli</option>
                                            <option name="bulan" value="8">Agustus</option>
                                            <option name="bulan" value="9">September</option>
                                            <option name="bulan" value="10">Oktober</option>
                                            <option name="bulan" value="11">November</option>
                                            <option name="bulan" value="12">Desember</option>
                                        {{-- @endforeach --}}
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="">Tahun</label>
                                    <input type="number" class="form-control" name="tahun" value="2023">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary form-control">Render Gaji Sales</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">  
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Gaji Bulanan Sales
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('gaji.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table id="example1" class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>Nama Sales</th>
                                        <th>Gaji Pokok</th>
                                        <th>Insentif Kunjungan</th>
                                        <th>Bonus Penjualan</th>
                                        <th>Total Gaji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalGaji as $item)
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            <td>Rp. {{ number_format($item->gapok, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($item->insentifKunjungan, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format(intval($item->bonusPenjualan), 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format(intval($item->totalGaji), 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary form-control">Simpan Data Gaji Sales</button>
                            </div>
                        </form>
                    </div>
                </div>       
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection

