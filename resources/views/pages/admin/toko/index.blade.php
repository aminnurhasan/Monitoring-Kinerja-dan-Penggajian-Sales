@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Toko</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('toko.index') }}">Toko</a></li>
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

                <a href="{{ route('toko.create') }}" class="btn btn-md btn-primary mb-2">Tambah Data Toko</a>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data Toko
                        </h3>
                    </div>
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-2">Nama Toko</th>
                                    <th class="col-2">Nama Sales</th>
                                    <th class="col-2">Alamat</th>
                                    <th class="col-1">Snippet</th>
                                    <th class="col-1">Status</th>
                                    {{-- <th class="col-1">Connect</th> --}}
                                    <th class="col-2">Action</th>
                                </tr>
                            </thead>  
                            <tbody>
                                @foreach ($toko as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->snippet }}</td>
                                        {{-- <td><span class="badge {{ ($item->status == 0 ) ? 'badge-danger' : 'badge-success' }}">{{ ($item->status == 0 ) ? 'Tidak Aktif' : 'Aktif' }}</span></td> --}}
                                        <td>
                                            @if ($item->status == 0)
                                                <a href="{{ route('statusToko', $item->id) }}" type="button" class="btn btn-danger">Mati</a>
                                            @else
                                                <a href="{{ route('statusToko', $item->id) }}" type="button" class="btn btn-success">Aktif</a>
                                            @endif
                                        </td>
                                        {{-- <td>@livewire('toko-status', ['model' => $item, 'field' => 'status'], key($toko->id))</td> --}}
                                        <td>
                                            <a href='{{ route('toko.show', $item->id) }}' class="btn btn-warning btn-sm fas fa-eye"></a>
                                            <a href='{{ url('toko/' . $item->id . '/edit') }}' class="btn btn-warning btn-sm fas fa-pen"></a>
                                            <form onsubmit="return confirm('Apakah Anda Ingin Menghapus Data ?')" class="d-inline"
                                                action="{{ url('toko/' . $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name='submit' class="btn btn-danger btn-sm fas fa-trash-can"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                              
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

@endsection
