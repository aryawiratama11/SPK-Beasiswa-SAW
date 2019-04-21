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
                <a class="list-group-item" href="{{ url('admin/hasilseleksi') }}">Hasil Seleksi</a>
                <a class="list-group-item" href="{{ url('admin/reset') }}">Reset</a>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Data Kriteria</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Data Alternatif</h2>      
                    <br/>
                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($alternatif as $detailalternatif)
                        <tr>
                            <td>{{$detailalternatif->nama}}</td>
                            <td>{{$detailalternatif->jkel}}</td>
                            <td>{{$detailalternatif->alamat}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
