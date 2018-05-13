@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <form method="get" action="{{route('user.close-absence')}}">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-danger">Tutup</button>
            </form>
        </div><br>
        <div class="row">
            @if(!empty($data))
                <table class="table table-responsive table-bordered table-primary">
                    <tr>
                        <td>No.</td>
                        <td>Siswa</td>
                        <td>Satus</td>
                    </tr>
                    <?php $i=0;?>
                    @foreach($data as $val)
                        <?php $i++;?>

                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$val->nama}}</td>
                            <td>{{$val->status}}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div class="panel panel-default">
                    <div class="panel-body center bg-danger">Tidak Ada Data</div>
                </div>
            @endif
        </div>
    </div>
@endsection
