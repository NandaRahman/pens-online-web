@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @role('admin')
            @if (\App\Models\StatusAbsensi::all()->where('tanggal','=', date('Y-m-d'))->count() == 0 )
                <div>
                    <a href="{{route('admin.open-absence')}}"><button class="btn btn-info btn-lg">Buka Absen</button></a>
                </div>
            @else
                <div>
                    <a href="" disabled=""><button disabled class="btn btn-info btn-lg">Absen Telah Dibuka</button></a>
                </div>
            @endif
            @endrole
            @role('user')
            @if(isset($data))
                <table class="table table-bordered">
                    <thead>
                        <td>Kelas</td>
                        <td>Pelajaran</td>
                        <td>Status</td>
                    </thead>
                    @foreach($data as $val)
                        <tr>
                            <td>{{$val->kode_kelas}}</td>
                            <td>{{$val->pelajaran}}</td>
                            <td>
                                <form method="post" action="{{route('user.open-absence')}}">
                                    @csrf
                                    <input type="hidden" value="{{$val->id}}" name="id">
                                    @if($val->avail==1)
                                        <button type="submit" class="btn btn-sm btn-success">Buka</button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-danger" disabled>Tutup</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
            @endrole

            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
