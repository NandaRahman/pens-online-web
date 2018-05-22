@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addTeacher">Tambah</button>
        </div><br>
        <div class="row">
            @if(!empty($data))
                <table class="table table-responsive table-bordered table-primary">
                    <tr>
                        <td>No. </td>
                        <td>NIP</td>
                        <td>Guru</td>
                        <td>Telepon</td>
                        <td>Alamat</td>
                        <td>Password Awal</td>
                        <td colspan="2">Opsi</td>
                    </tr>
                    @foreach($data as $val)
                        <tr>
                            <td>{{$val->id}}</td>
                            <td>{{$val->nomor_pegawai}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->telepon}}</td>
                            <td>{{$val->alamat}}</td>
                            <td>{{$val->token_first_login}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData-{{$val->id}}">Ubah</button>
                            </td>
                            <td>
                                <form method="post" action="{{route('admin.teacher-delete')}}">
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
                                        <h4 class="modal-title">Perbarui Data Guru</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('admin.teacher-edit') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="nama" placeholder="Masukan Nama" name="id" value="{{$val->id}}">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="nama" placeholder="Masukan Nama" name="name" value="{{$val->name}}">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" placeholder="Enter Username" name="username" value="{{$val->username}}">
                                                @if ($errors->has('username'))
                                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_pegawai">Nomor Pegawai</label>
                                                <input type="text" class="form-control {{ $errors->has('nomor_pegawai') ? ' is-invalid' : '' }}" id="nomor_pegawai" placeholder="Masukan NIP" name="nomor_pegawai" value="{{$val->nomor_pegawai}}">
                                                @if ($errors->has('nomor_pegawai'))
                                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nomor_pegawai') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="telepon">Telepon</label>
                                                <input type="text" class="form-control {{ $errors->has('telepon') ? ' is-invalid' : '' }}" id="telepon" placeholder="Enter telepon" name="telepon" value="{{$val->telepon}}">
                                                @if ($errors->has('telepon'))
                                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('telepon') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" id="alamat" placeholder="Masukan Alamat" name="alamat" value="{{$val->alamat}}">
                                                @if ($errors->has('alamat'))
                                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <div id="addTeacher" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Masukan Jadwal</h4>
                    </div>
                    <div class="modal-body">
                        {{--Tab Init--}}
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#excel">Excel</a></li>
                            <li><a data-toggle="tab" href="#manual">Manual</a></li>
                        </ul>
                        {{--Tab Content--}}
                        <div class="tab-content">
                            <div id="excel" class="tab-pane fade in active">
                                <h3>Excel Format</h3>
                                <form method="POST" action="{{ route('admin.teacher-add') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="upload">Upload Excel File</label>
                                        <input type="file" class="form-control" id="file_upload" placeholder="Enter username" name="file_upload">
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </form>
                            </div>
                            <div id="manual" class="tab-pane fade">
                                <h3>Insert Data Guru</h3>
                                <form method="POST" action="{{ route('admin.teacher-add') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="nama" placeholder="Masukan Nama" name="name">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" placeholder="Enter Username" name="username">
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_pegawai">Nomor Pegawai</label>
                                        <input type="text" class="form-control {{ $errors->has('nomor_pegawai') ? ' is-invalid' : '' }}" id="nomor_pegawai" placeholder="Masukan NIP" name="nomor_pegawai">
                                        @if ($errors->has('nomor_pegawai'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nomor_pegawai') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" class="form-control {{ $errors->has('telepon') ? ' is-invalid' : '' }}" id="telepon" placeholder="Enter telepon" name="telepon">
                                        @if ($errors->has('telepon'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('telepon') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}" id="alamat" placeholder="Masukan Alamat" name="alamat">
                                        @if ($errors->has('alamat'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('alamat') }}</strong>
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
        </div>
    </div>
@endsection
