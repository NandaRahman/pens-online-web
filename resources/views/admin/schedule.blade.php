@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12" style="margin-top: 1%">
            <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#addData">Tambah</button>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Jadwal
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    {{--<div class="table-responsive">--}}
                        @if(!empty($data))
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Guru</th>
                                    <th>Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th colspan="2">Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $val)
                                    <tr class="odd gradeA">
                                        <td>{{$val->id}}</td>
                                        <td>{{$val->id_guru}}</td>
                                        <td>{{$val->id_pelajaran}}</td>
                                        <td>{{$val->id_kelas}}</td>
                                        <td>{{$val->hari}}</td>
                                        <td>{{$val->jam}}</td>
                                        <td>{{$val->hari}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editData-{{$val->id}}">Ubah</button>
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('admin.schedule-delete')}}">
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
                                                    <form method="POST" action="{{ route('admin.schedule-edit') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="guru">Guru</label>
                                                            <select id="guru" data-placeholder="Nama Guru" class="chosen-select form-control" name="id_guru" tabindex="6">
                                                                <option value=""></option>
                                                                @foreach($teacher as $guru)
                                                                    @if($val->id_guru === $guru->id)
                                                                        <option value="{{$guru->id}}" selected>{{$guru->name}}</option>
                                                                    @else
                                                                        <option value="{{$guru->id}}">{{$guru->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kelas">Kelas</label>
                                                            <select id="kelas" data-placeholder="Nama Kelas" class="chosen-select form-control" name="id_kelas" tabindex="6">
                                                                <option value=""></option>
                                                                @foreach($class as $kelas)
                                                                    @if($val->id_kelas === $kelas->id)
                                                                        <option value="{{$kelas->id}}" selected>{{$kelas->kelas." ".$kelas->jurusan." ".$kelas->pararel}}</option>
                                                                    @else
                                                                        <option value="{{$kelas->id}}">{{$kelas->kelas." ".$kelas->jurusan." ".$kelas->pararel}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pelajaran">Pelajaran</label>
                                                            <select id="pelajaran" data-placeholder="Nama Pelajaran" class="chosen-select form-control" name="id_pelajaran" tabindex="6">
                                                                <option value=""></option>
                                                                @foreach($lesson as $pelajaran)
                                                                    @if($val->id_pelajaran === $pelajaran->id)
                                                                        <option value="{{$pelajaran->id}}" selected>{{$pelajaran->nama}}</option>
                                                                    @else
                                                                        <option value="{{$pelajaran->id}}">{{$pelajaran->nama}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="hari">Hari</label>
                                                            <select id="hari" data-placeholder="Hari" class="chosen-select form-control" name="hari" tabindex="6">
                                                                <option value=""></option>
                                                                @if($val->hari == 1)<option value="1" selected>Senin</option>@else<option value="1">Senin</option>@endif
                                                                @if($val->hari == 2)<option value="2" selected>Selasa</option>@else<option value="2">Selasa</option>@endif
                                                                @if($val->hari == 3)<option value="3" selected>Rabu</option>@else<option value="3">Rabu</option>@endif
                                                                @if($val->hari == 4)<option value="4" selected>Kamis</option>@else<option value="4">Kamis</option>@endif
                                                                @if($val->hari == 5)<option value="5" selected>Jum'at</option>@else<option value="5">Jum'at</option>@endif
                                                                @if($val->hari == 6)<option value="6" selected>Sabtu</option>@else<option value="6">Sabtu</option>@endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jam">Jam ke</label>
                                                            <select id="jam" data-placeholder="Jam ke" class="chosen-select form-control" name="jam" tabindex="6">
                                                                <option value=""></option>
                                                                @foreach($time as $jam)
                                                                    @if($val->jam === $jam->id)
                                                                        <option value="{{$jam->id}}" selected>{{$jam->jam}}</option>
                                                                    @else
                                                                        <option value="{{$jam->id}}">{{$jam->jam}}</option>
                                                                    @endif
                                                                @endforeach
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
                                </tbody>
                            </table>
                        @else
                            <div class="panel panel-default">
                                <div class="panel-body center bg-danger">Tidak Ada Data</div>
                            </div>
                        @endif
                    {{--</div>--}}
                </div>
            </div>
            <!-- /.panel-body -->

            <!-- Modal -->
            <div id="addData" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Masukan Jadwal</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('admin.schedule-add') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="guru">Guru</label>
                                    <select id="guru" data-placeholder="Nama Guru" class="chosen-select form-control" name="id_guru" tabindex="6">
                                        <option value=""></option>
                                        @foreach($teacher as $guru)
                                            <option value="{{$guru->id}}">{{$guru->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select id="kelas" data-placeholder="Nama Kelas" class="chosen-select form-control" name="id_kelas" tabindex="6">
                                        <option value=""></option>
                                        @foreach($class as $kelas)
                                            <option value="{{$kelas->id}}">{{$kelas->kelas." ".$kelas->jurusan." ".$kelas->pararel}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pelajaran">Pelajaran</label>
                                    <select id="pelajaran" data-placeholder="Nama Pelajaran" class="chosen-select form-control" name="id_pelajaran" tabindex="6">
                                        <option value=""></option>
                                        @foreach($lesson as $pelajaran)
                                            <option value="{{$pelajaran->id}}">{{$pelajaran->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="hari">Hari</label>
                                    <select id="hari" data-placeholder="Hari" class="chosen-select form-control" name="hari" tabindex="6">
                                        <option value=""></option>
                                        <option value="1">Senin</option>
                                        <option value="2">Selasa</option>
                                        <option value="3">Rabu</option>
                                        <option value="4">Kamis</option>
                                        <option value="5">Jum'at</option>
                                        <option value="6">Sabtu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jam">Jam ke</label>
                                    <select id="jam" data-placeholder="Jam ke" class="chosen-select form-control" name="jam" tabindex="6">
                                        <option value=""></option>
                                        @foreach($time as $jam)
                                            <option value="{{$jam->id}}">{{$jam->jam}}</option>
                                        @endforeach
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

        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

@endsection
