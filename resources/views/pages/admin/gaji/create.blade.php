@extends('layouts.admin.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Gaji Sales</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('gaji.index') }}">Gaji</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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

                <a href="{{ url()->previous() }}" class="btn btn-md btn-primary mb-2">Kembali</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Generate Gaji Bulanan Sales
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('gaji.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="">Bulan</label>
                                    <select name="bulan" class="form-control">
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
            </section>
        </div>
    </div>
</section>
@endsection

