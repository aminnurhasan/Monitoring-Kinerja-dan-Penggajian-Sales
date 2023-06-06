@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Toko</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Toko</li>
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

                <a href="{{ route('toko.create') }}" class="btn btn-sm btn-primary mb-2">Add</a>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Toko
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Sales</th>
                                    <th>Nama Toko</th>
                                    <th>Alamat</th>
                                    <th>Snippet</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>  
                            <tbody>
                                @foreach ($toko as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->snippet }}</td>
                                        <td>@livewire('toko-status', ['model' => $item, 'field' => 'status'], key($toko->id))</td>
                                        <td>
                                            <a href='{{ route('toko.show', $item->id) }}' class="btn btn-warning btn-sm">Show</a>
                                            <a href='{{ url('toko/' . $item->id . '/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                                            <form onsubmit="return confirm('Apakah Anda Ingin Menghapus Data ?')" class="d-inline"
                                                action="{{ url('toko/' . $item->id) }}" method="post">
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
