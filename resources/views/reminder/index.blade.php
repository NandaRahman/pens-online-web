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
                        <div class="row">
                            <div id="user" class="form-group col-lg-4 col-sm-4"></div>
                            <div id="reminder" class="form-group col-lg-4 col-sm-4"></div>
                            <div class="form-group  col-lg-offset-2 col-lg-2 col-sm-4">
                                <a href="{{route("reminder:add")}}"><button class="btn btn-default"><span><i class="fa fa-plus"> </i>Tambah</span></button></a>
                            </div>
                        </div>
                        <div class="table">
                            <table class="table table-striped table-bordered table-info" id="table">
                                <thead>
                                <tr >
                                    <th>No.</th>
                                    <th>Pengguna</th>
                                    <th>Tanggal</th>
                                    <th>Info</th>
                                    <th>Reminder</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="table_content">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <script>
        var table;
        $(document).ready(function () {
            $data = {
                status:["1","0"]
            };
            $.post("{{route('reminder:get')}}", $data,
                function(data){
                console.log(data);
                    $("#table_content").html(data);
                    table = $("#table").DataTable({
                        ordering:false,
                        initComplete: function() {
                            var user = this.api().column(1);
                            var select_user = $('<select class="form-control filter-user"><option value="">-- Pengguna --</option></select>')
                                .appendTo('#user')
                                .on('change', function() {
                                    var val = $(this).val();
                                    user.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
                                });
                            user.data().unique().sort().each(function(d, j) {
                                select_user.append('<option value="' + d + '">' + d + '</option>');
                            });
                            var reminder = this.api().column(4);
                            var select_reminder = $('<select class="form-control filter-reminder"><option value="">-- Reminder --</option></select>')
                                .appendTo('#reminder')
                                .on('change', function() {
                                    var val = $(this).val();
                                    reminder.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
                                });
                            reminder.data().unique().sort().each(function(d, j) {
                                var elm = d.slice(34, -7);
                                select_reminder.append('<option value="' + elm + '">' + elm + '</option>');
                            });
                        }
                    });
                });
        });
    </script>
    <style>
        .dataTables_filter, .dataTables_grouping { display: none; }
    </style>
    <!-- /#page-wrapper -->
@endsection
