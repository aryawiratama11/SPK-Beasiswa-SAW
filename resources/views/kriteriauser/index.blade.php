@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="list-group table-of-contents">
                <a class="list-group-item" href="{{ url('home') }}">Home</a>
                <a class="list-group-item" href="{{ url('kriteria') }}">Data Kriteria</a>
                <a class="list-group-item" href="{{ url('range') }}">Data Range</a>
                <a class="list-group-item" href="{{ url('alternatif') }}">Data Alternatif</a>
                <a class="list-group-item" href="{{ url('hasilseleksi') }}">Hasil Seleksi</a>
                
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

                    <h2>Data Kriteria</h2>      
                    <br/>
                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Kode Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Atribut</th>
                            <th>Bobot</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($kriteria as $detailkriteria)
                        <tr>
                            <td>{{$detailkriteria->id}}</td>
                            <td>{{$detailkriteria->nama}}</td>
                            <td>{{$detailkriteria->atribut}}</td>
                            <td>{{$detailkriteria->bobot}}</td>
                            
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Kriteria</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('kriteria')}}">
        <div class="form-group">
            <label for="namakriteria">Nama Kriteria:</label>
            <input name="nama" type="text" class="form-control" id="namakriteria">
            {{csrf_field()}}
        </div>
        <div class="form-group">
            <label for="atribut">Atribut:</label>
            <select class="form-control" id="atribut" name="atribut">
                <option>Cost</option>
                <option>Benefit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bobot">Bobot:</label>
            <input name="bobot" type="number" class="form-control" id="bobot">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection
