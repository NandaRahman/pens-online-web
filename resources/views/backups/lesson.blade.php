@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addClass">Tambah</button>
        </div><br>
        <div class="row">
            @if(!empty($data))
                <table class="table table-responsive table-bordered table-primary">
                    <tr>
                        <td>No.</td>
                        <td>Nama</td>
                        <td>Deskripsi</td>
                        <td>Jam</td>
                        <td colspan="2">Opsi</td>
                    </tr>
                    @foreach($data as $val)
                        <tr>
                            <td>{{$val->id}}</td>
                            <td>{{$val->nama}}</td>
                            <td>{{$val->deskripsi}}</td>
                            <td>{{$val->jam}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData-{{$val->id}}">Ubah</button>
                            </td>
                            <td>
                                <form method="post" action="{{route('admin.class-delete')}}">
                                    {{ csrf_field() }}
                                    <input value="{{$val->id}}" name="id" type="hidden">
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div id="editData-{{$val->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Perbarui Data Pelajaran</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('admin.lesson-edit') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="number" class="form-control {{ $errors->has('kelas') ? ' is-invalid' : '' }}" id="kelas" placeholder="Masukan Kelas" name="id" value="{{$val->id}}">
                                            <div class="form-group">
                                                <label for="nama">Pelajaran</label>
                                                <input type="text" class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}" id="nama" placeholder="Masukan Nama" name="nama" value="{{$val->nama}}">
                                                @if ($errors->has('nama'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nama') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi</label>
                                                <input type="text" class="form-control {{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" id="deskripsi" placeholder="Masukan Deskripsi" name="deskripsi" value="{{$val->deskripsi}}">
                                                @if ($errors->has('deskripsi'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="jam">Jam</label>
                                                <input type="number" class="form-control {{ $errors->has('jam') ? ' is-invalid' : '' }}" id="jam" placeholder="Masukan Jam" name="jam"  value="{{$val->jam}}">
                                                @if ($errors->has('jam'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('jam') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>
            @else
                <div class="panel panel-default">
                    <div class="panel-body center bg-danger">Tidak Ada Data</div>
                </div>
            @endif
        </div>

        <!-- Modal -->
        <div id="addClass" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Masukan Jadwal</h3>
                    </div>
                    <div class="modal-body">
                        {{--Tab Init--}}
                        <form method="POST" action="{{ route('admin.lesson-add') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nama">Pelajaran</label>
                                <input type="text" class="form-control {{ $errors->has('nama') ? ' is-invalid' : '' }}" id="nama" placeholder="Masukan Nama" name="nama">
                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" class="form-control {{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" id="deskripsi" placeholder="Masukan Deskripsi" name="deskripsi">
                                @if ($errors->has('deskripsi'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="jam">Jam</label>
                                <input type="number" class="form-control {{ $errors->has('jam') ? ' is-invalid' : '' }}" id="jam" placeholder="Masukan Jam" name="jam">
                                @if ($errors->has('jam'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('jam') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
