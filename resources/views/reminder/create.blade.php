@extends('layouts.master')
@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Reminder</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form action="{{route('reminder:create')}}" method="post">
                            <div class="form-group">
                                <label for="pengguna">Pengguna</label>
                                <select id="pengguna" name="state" class="form-control" required>
                                    <option value="">-- Pilih Pengguna --</option>
                                    <option value="1">Mahasiswa</option>
                                    <option value="0">Pegawai</option>
                                </select>
                            </div>
                            <div id="mahasiswa">
                                <div class="form-group">
                                    <label for="tujuan_mahasiswa">Kirim ke</label>
                                    <select id="tujuan_mahasiswa" name="user[]"  data-placeholder="Pilih NRP Mahasiswa.." class="chosen-select form-control" multiple>
                                        @if(!empty($mahasiswa))
                                            @foreach($mahasiswa as $val)
                                                <option value="{{$val->nomor}}">{{$val->nrp}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div id="pegawai">
                                <div class="form-group">
                                    <label for="tujuan_pegawai">Kirim ke</label>
                                    <select id="tujuan_pegawai"  data-placeholder="Pilih Nama Pegawai.." name="user[]" class="form-control chosen-select" multiple>
                                        @if(!empty($pegawai))
                                            @foreach($pegawai as $val)
                                                <option value="{{$val->nomor}}">{{$val->nama}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="judul">Judul</label>
                                <input id="judul" name="title" class="form-control" placeholder="Judul" required>
                            </div>
                            <div class="form-group">
                                <label id="pesan">Pesan</label>
                                <input id="pesan" name="message" class="form-control" placeholder="Pesan" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" name="submit" type="submit">Tambah</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <script>
        $(document).ready(function () {
            $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
            $("#pegawai").attr('class', 'hide');
            $("#mahasiswa").attr('class', 'hide');
        });
        $("#pengguna").change(function () {
            var user = $("#pengguna").val();
            if(user == 0){
                $("#mahasiswa").attr('class', 'hide');
                $("#pegawai").attr('class','');
            }else if(user == 1){
                $("#mahasiswa").attr('class', '');
                $("#pegawai").attr('class', 'hide');
            }else {
                $("#mahasiswa").attr('class', 'hide');
                $("#pegawai").attr('class', 'hide');
            }
        });

    </script>

    <!-- /#page-wrapper -->
@endsection
