@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Guru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Data Guru</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <a href="{{ route('createGuru') }}" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Tambah Baru</a>
                 <a href="{{ url('schedule') }}" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Tambah Jadwal Guru</a>
              </div>
              <div class="card-body table-responsive p-0" style="height: 400px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Mata Kuliah</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($guru as $key => $item)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->nip }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                              @if ($item->jenis_kelamin == 'L')
                                  Laki - Laki
                              @else
                                  Perempuan
                              @endif
                            </td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_telp }}</td>
                            <td>{{ $item->mapel->nama_mapel }}</td>
                            <td>
                              <a href="{{ route('editGuru', $item->id) }}" class="badge badge-warning">Edit</a>
                              <a href="{{ route('deleteGuru', $item->id) }}" class="badge badge-danger">Delete</a>
                              <a href="{{ url('guru_list_jadwal/'. $item->nip) }}" class="badge badge-success">Jadwal</a>
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection