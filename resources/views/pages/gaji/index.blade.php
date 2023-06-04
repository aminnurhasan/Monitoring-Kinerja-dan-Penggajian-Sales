@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Gaji Sales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Gaji</li>
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

                <a href="{{ route('gaji.create') }}" class="btn btn-sm btn-primary mb-2">Add</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Generate Gaji Bulanan Sales
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('gaji.store') }}" method="post" enctype="multipart/form-data">
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
                            Gaji Sales
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Sales</th>
                                    <th>Bulan</th>
                                    <th>Gaji Pokok</th>
                                    <th>Insentif Kunjungan</th>
                                    <th>Bonus Penjualan</th>
                                    <th>Total Gaji</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gaji as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                            @if($item->bulan == 1)
                                                <td>Januari</td>
                                            @elseif($item->bulan == 2)
                                                <td>Februari</td>
                                            @elseif($item->bulan == 3)
                                                <td>Maret</td>
                                            @elseif($item->bulan == 4)
                                                <td>April</td>
                                            @elseif($item->bulan == 5)
                                                <td>Mei</td>
                                            @elseif($item->bulan == 6)
                                                <td>Juni</td>
                                            @elseif($item->bulan == 7)
                                                <td>Juli</td>
                                            @elseif($item->bulan == 8)
                                                <td>Agustus</td>
                                            @elseif($item->bulan == 9)
                                                <td>September</td>
                                            @elseif($item->bulan == 10)
                                                <td>Oktober</td>
                                            @elseif($item->bulan == 11)
                                                <td>November</td>
                                            @else
                                                <td>Desember</td>
                                            @endif
                                        <td>{{ $item->gajiPokok }}</td>
                                        <td>{{ $item->insentifKunjungan }}</td>
                                        <td>{{ $item->bonusPenjualan }}</td>
                                        <td>{{ $item->gajiTotal }}</td>
                                        <td>
                                            <a href='{{ route('gaji.show', $item->id) }}' class="btn btn-warning btn-sm">Show</a>
                                            <a href='{{ url('gaji/' . $item->id . '/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                                            <form onsubmit="return confirm('Apakah Anda Ingin Menghapus Data ?')" class="d-inline"
                                                action="{{ url('gaji/' . $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name='submit' class="btn btn-danger btn-sm">Del</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

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