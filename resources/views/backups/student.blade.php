@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row container-fluid">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#manual">Manual</a></li>
                <li><a data-toggle="tab" href="#excel">Excel</a></li>
            </ul>
            {{--Tab Content--}}
            <div class="tab-content">
                <div id="excel" class="tab-pane fade ">
                    <h3>Excel Format</h3>
                    <form method="POST" action="{{ route('admin.student-add') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="upload">Upload Excel File</label>
                            <input type="file" class="form-control" id="file_upload" placeholder="Enter username" name="file_upload">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div id="manual" class="tab-pane fade in active">
                    <h3>Insert Data Siswa</h3>
                    <form method="post" action="{{ route('admin.student-add') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nomor_pelajar">Nomor</label>
                            <input type="text" class="form-control {{ $errors->has('nomor_pelajar') ? ' is-invalid' : '' }}" id="nomor_pelajar" placeholder="Masukan Nomor Pelajar" name="nomor_pelajar">
                            @if ($errors->has('nomor_pelajar'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('nomor_pelajar')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="nama" placeholder="Masukan Nama" name="nama">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control {{ $errors->has('telepon') ? ' is-invalid' : '' }}" id="telepon" placeholder="Masukan Telepon" name="telepon">
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
                        <div class="form-group">
                            <label for="username">Kelas</label>
                            <select data-placeholder="Masukan Kelas" class="chosen-select form-control"  tabindex="6" name="id_kelas">
                                <option value=""></option>
                                @if(!empty($data_class))
                                    @foreach($data_class as $kelas)
                                        <option value="{{$kelas->id}}">{{$kelas->kelas." ".$kelas->jurusan." ".$kelas->pararel}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div><br>
        <div class="row">
            @if(!empty($data_student))
                <table class="table table-responsive table-bordered table-primary" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nomor Pelajar</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Kelas</th>
                        <th colspan="2">Opsi</th>
                    </tr>
                    </thead>
                    @foreach($data_student as $val)
                        <tr>
                            <td>{{$val->id}}</td>
                            <td>{{$val->nomor_pelajar}}</td>
                            <td>{{$val->nama}}</td>
                            <td>{{$val->telepon}}</td>
                            <td>{{$val->alamat}}</td>
                            <td>{{$val->id_kelas}}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData-{{$val->id}}">Ubah</button>
                            </td>
                            <td>
                                <form method="post" action="{{route('admin.student-delete')}}">
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
                                        <h3>Insert Data Siswa</h3>
                                        <form method="post" action="{{ route('admin.student-edit') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="text" class="form-control {{ $errors->has('nomor_pelajar') ? ' is-invalid' : '' }}" id="nomor_pelajar" placeholder="Masukan Nomor Pelajar" name="id" value="{{$val->id}}">
                                            <div class="form-group">
                                                <label for="nomor_pelajar">Nomor</label>
                                                <input type="text" class="form-control {{ $errors->has('nomor_pelajar') ? ' is-invalid' : '' }}" id="nomor_pelajar" placeholder="Masukan Nomor Pelajar" name="nomor_pelajar" value="{{$val->nomor_pelajar}}">
                                                @if ($errors->has('nomor_pelajar'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nomor_pelajar')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="nama" placeholder="Masukan Nama" name="nama" value="{{$val->nama}}">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="telepon">Telepon</label>
                                                <input type="text" class="form-control {{ $errors->has('telepon') ? ' is-invalid' : '' }}" id="telepon" placeholder="Masukan Telepon" name="telepon" value="{{$val->telepon}}">
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
                                            <div class="form-group">
                                                <label for="username">Kelas</label>
                                                <select data-placeholder="Masukan Kelas" class="chosen-select form-control"  tabindex="6" name="id_kelas">
                                                    <option value=""></option>
                                                    @if(!empty($data_class))
                                                        @foreach($data_class as $kelas)
                                                            @if($val->id_kelas == $kelas->id)
                                                                <option value="{{$kelas->id}}" selected>{{$kelas->kelas." ".$kelas->jurusan." ".$kelas->pararel}}</option>
                                                            @else
                                                                <option value="{{$kelas->id}}">{{$kelas->kelas." ".$kelas->jurusan." ".$kelas->pararel}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
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
        <div id="addStudent" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Masukan Siswa</h4>
                    </div>
                    <div class="modal-body">
                        {{--Tab Init--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".chosen-select").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    </script>
@endsection
