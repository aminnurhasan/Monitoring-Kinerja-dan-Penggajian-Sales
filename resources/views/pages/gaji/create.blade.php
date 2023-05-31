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
                            Insentif
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('gaji.create') }}" method="get" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Sales</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($user as $user)
                                            <option name="user_id" value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="">Gaji Pokok Bulanan</label>
                                    <input type="number" name="gajiPokok" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="">Tanggal Awal</label>
                                    <input type="text" name="tanggalAwal" class="form-control" placeholder="yyyy-mm-dd">
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <div class="col">
                                    <label for="">Bonus Insentif Per Kunjungan</label>
                                    <input type="number" name="bonusKunjungan" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="">Tanggal Akhir</label>
                                    <input type="text" name="tanggalAkhir" class="form-control" placeholder="yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary form-control">Tampilkan Detail</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Gaji Sales
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('gaji.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label>Nama Sales</label>
                                    <input type="text" class="form-control" disabled value="{{$nama}}">            
                                </div>
                                <div class="col">
                                    <label>Tanggal Awal</label>
                                    <input type="text" class="form-control" disabled value="{{$tanggalAwal}}">        
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Gaji Pokok</label>
                                    <input type="text" class="form-control" disabled value="Rp. {{number_format($gajiPokok, 0, ',', '.')}}">            
                                </div>
                                <div class="col">
                                    <label>Tanggal Akhir</label>
                                    <input type="text" class="form-control" disabled value="{{$tanggalAkhir}}">        
                                </div>
                            </div>
                            <div class="form-group row">
                                @foreach ($totalKunjungan as $kunjungan)
                                    <div class="col">
                                        <label>Total Kunjungan</label>
                                        <input type="text" class="form-control" disabled value="{{$kunjungan->kunjungan}} Kunjungan">        
                                    </div>
                                    <div class="col">
                                        <label>Total Insentif Kunjungan</label>
                                        <input type="text" class="form-control" disabled value="Rp. {{number_format($totalInsentifKunjungan, 0, ',', '.')}}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Total Quantity</label>
                                    <input type="text" class="form-control" disabled value="{{$quantitySales}} Packs">        
                                </div>
                                <div class="col">
                                    <label>Total Penjualan</label>
                                    <input type="text" class="form-control" disabled value="Rp. {{number_format($penjualanSales, 0, ',', '.')}}">        
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Bonus Penjualan</label>
                                    <input type="text" class="form-control" disabled value="Rp. {{number_format($bonusPenjualan, 0, ',', '.')}}">        
                                </div>
                                <div class="col">
                                    <label>Total Gaji</label>
                                    <input type="text" class="form-control" disabled value="Rp. {{number_format($totalGaji, 0, ',', '.')}}">        
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary form-control">Simpan Gaji Sales</button>
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

