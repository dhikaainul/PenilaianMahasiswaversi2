@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Absensi Guru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a Nilai Siswa>
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
                 <form role="form" action="{{ url('filter_guru_absen') }}" method="POST">
                @csrf
                 <div class="form-group">
                    <label for="mapel">Pilih Guru</label>
                    <select class="form-control select2bs4" name="id_guru" style="width: 100%;" required>
                      <option selected disable value="0">Pilih Guru</option>
                      @foreach ($guru as $item)
                        <option value="{{ $item->id }}">{{ $item->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                   <div class="card-footer">
                  <button type="submit" class="btn btn-primary mr-1">Filter</button>
                  <a href="{{ url('absen_guru') }}" class="btn btn-default">Reset</a>
                </div>
                </form>
               </div>
              <div class="card-body table-responsive p-0">
                 @if(count($absensi)>0)
                <p align="center"> ABSENSI GURU {{$guru_s->nama}}</p>
                @endif
              <table class="table text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>MAPEL</th>
                        <th>GURU</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($absensi)>0)
                      @foreach ($absensi as $key => $item)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->datetime }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->mapel->nama_mapel }}</td>
                            <td>{{ $item->guru->nama }}</td>
                          </tr>
                      @endforeach
                      @endif
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