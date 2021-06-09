@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Guru Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('guru') }}">Data Guru</a></li>
              <li class="breadcrumb-item active">Atur Jadwal Guru</li>
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
              <form role="form" action="{{ url('guru/schedule/edit/'.$guru->schedule_id) }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="mapel">Pilih Hari</label>
                   <select class="form-control select2bs4" name="day" id="mapel" style="width: 100%;" required>
                        <option value="Senin" {{ $guru->day == 'Senin' ? 'selected' : '' }} >Senin</option>
                        <option value="Selasa" {{ $guru->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ $guru->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ $guru->day == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ $guru->day == 'Jumat' ? 'selected' : '' }}>Jum'at</option>
                        <option value="Sabtu" {{ $guru->day == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="mapel">Pilih Guru</label>
                    <select disabled class="form-control select2bs4" name="guru_id" id="id_guru_select" style="width: 100%;" required>
                      <option selected disable value="0">{{$guru->nama}}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nip">Mapel</label>
                    <input type="text" readonly class="form-control" value="{{$matkul->nama_mapel}}" id="nama_mapel" required>
                  </div>
                   <div class="form-group">
                    <label for="nip">Waktu Mulai</label>
                    <input type="time" class="form-control" id="nip" value="{{$guru->start_time}}" name="start_time" placeholder="Waktu Mulai" required>
                  </div>
                   <div class="form-group">
                    <label for="nip">Waktu Selesai</label>
                    <input type="time" class="form-control" id="nip" value="{{$guru->end_time}}" name="end_time" placeholder="Waktu Selesai" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary mr-1">Submit</button>
                  <a href="{{ route('guru') }}" class="btn btn-default">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection