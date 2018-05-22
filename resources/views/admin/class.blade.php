@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12" style="margin-top: 1%">
            <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#addClass">Tambah</button>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Kelas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @if(!empty($data))
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Pararel</th>
                                <th>Kode Kelas</th>
                                <th colspan="2">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $val)
                                <tr class="odd gradeA">
                                    <td>{{$val->id}}</td>
                                    <td>{{$val->kelas}}</td>
                                    <td>{{$val->jurusan}}</td>
                                    <td>{{$val->pararel}}</td>
                                    <td>{{$val->kode_kelas}}</td>
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
                                                <h4 class="modal-title">Perbarui Data Guru</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('admin.class-edit') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="number" class="form-control {{ $errors->has('kelas') ? ' is-invalid' : '' }}" id="kelas" placeholder="Masukan Kelas" name="id" value="{{$val->id}}">
                                                    <div class="form-group">
                                                        <label for="kelas">Kelas</label>
                                                        <input type="number" class="form-control {{ $errors->has('kelas') ? ' is-invalid' : '' }}" id="kelas" placeholder="Masukan Kelas" name="kelas" value="{{$val->kelas}}">
                                                        @if ($errors->has('kelas'))
                                                            <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('kelas') }}</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jurusan">Jurusan</label>
                                                        <input type="text" class="form-control {{ $errors->has('jurusan') ? ' is-invalid' : '' }}" id="jurusan" placeholder="Masukan Jurusan" name="jurusan" value="{{$val->jurusan}}">
                                                        @if ($errors->has('jurusan'))
                                                            <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('jurusan') }}</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pararel">Pararel</label>
                                                        <input type="number" class="form-control {{ $errors->has('pararel') ? ' is-invalid' : '' }}" id="pararel" placeholder="Masukan Pararel" name="pararel"  value="{{$val->pararel}}">
                                                        @if ($errors->has('pararel'))
                                                            <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('pararel') }}</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kode_kelas">Kode Kelas</label>
                                                        <input type="text" class="form-control {{ $errors->has('kode_kelas') ? ' is-invalid' : '' }}" id="kode_kelas" placeholder="Masukan Kode Kelas" name="kode_kelas"  value="{{$val->kode_kelas}}">
                                                        @if ($errors->has('kode_kelas'))
                                                            <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('kode_kelas') }}</strong>
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
                            </tbody>
                        {{--</table>--}}
                        <!-- /.table-responsive -->
                        </table>
                    @else
                        <div class="panel panel-default">
                            <div class="panel-body center bg-danger">Tidak Ada Data</div>
                        </div>
                    @endif
                    {{--</div>--}}
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
                                <form method="POST" action="{{ route('admin.class-add') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <input type="number" class="form-control {{ $errors->has('kelas') ? ' is-invalid' : '' }}" id="kelas" placeholder="Masukan Kelas" name="kelas">
                                        @if ($errors->has('kelas'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('kelas') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label>
                                        <input type="text" class="form-control {{ $errors->has('jurusan') ? ' is-invalid' : '' }}" id="jurusan" placeholder="Masukan Jurusan" name="jurusan">
                                        @if ($errors->has('jurusan'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('jurusan') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="pararel">Pararel</label>
                                        <input type="number" class="form-control {{ $errors->has('pararel') ? ' is-invalid' : '' }}" id="pararel" placeholder="Masukan Pararel" name="pararel">
                                        @if ($errors->has('pararel'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('pararel') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_kelas">Kode Kelas</label>
                                        <input type="text" class="form-control {{ $errors->has('kode_kelas') ? ' is-invalid' : '' }}" id="kode_kelas" placeholder="Masukan Kode Kelas" name="kode_kelas">
                                        @if ($errors->has('kode_kelas'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('kode_kelas') }}</strong>
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
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

@endsection