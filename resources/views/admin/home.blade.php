@extends('admin.layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="list-group table-of-contents">
                <a class="list-group-item" href="{{ url('admin/home') }}">Home</a>
                <a class="list-group-item" href="{{ url('admin/kriteria') }}">Data Kriteria</a>
                <a class="list-group-item" href="{{ url('admin/range') }}">Data Range</a>
                <a class="list-group-item" href="{{ url('admin/alternatif') }}">Data Alternatif</a>
               
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <center>
                        <img src="{{asset('img/logo.jpg')}}"/>
                    </center>

                    <center>Selamat Datang di Admin Panel</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
