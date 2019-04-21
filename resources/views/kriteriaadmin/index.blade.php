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

                    <h2>Data Kriteria</h2>      
                    <button type="button" data-toggle="modal" data-target="#myModal" class="col-lg-2 btn btn-primary pull-right">Tambah</button>
                    <br/>
                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Kode Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Atribut</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($kriteria as $detailkriteria)
                        <tr>
                            <td>{{$detailkriteria->id}}</td>
                            <td>{{$detailkriteria->nama}}</td>
                            <td>{{$detailkriteria->atribut}}</td>
                            <td>{{$detailkriteria->bobot}}</td>
                            <td>
									<button type="button" data-toggle="modal" data-target="#modal{{$detailkriteria->id}}" class="btn btn-info btn-xs">Edit</button>

									<button type="button" onclick="event.preventDefault();
                                                     document.getElementById('delete{{$detailkriteria->id}}-form').submit();" class="btn btn-danger btn-xs btn-delete" value="1">Hapus</button>
                                    <form id="delete{{$detailkriteria->id}}-form" action="{{ url('admin/kriteria/') }}/{{$detailkriteria->id}}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE')}}  
                                    </form>
                            </td>
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
      <form method="post" action="{{url('admin/kriteria')}}">
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
@foreach ($kriteria as $detailkriteria)
<!-- Modal -->
<div id="modal{{$detailkriteria->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Kriteria</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('admin/kriteria/'.$detailkriteria->id)}}">
        <div class="form-group">
            <label for="namakriteria">Nama Kriteria:</label>
            <input name="nama" type="text" class="form-control" id="namakriteria" value="{{$detailkriteria->nama}}">
            {{csrf_field()}}
            {{ method_field('PUT')}}  
        </div>
        <div class="form-group">
            <label for="atribut">Atribut:</label>
            <select class="form-control" id="atribut" name="atribut">
                @if($detailkriteria->atribut == "Cost")
                <option>Cost</option>
                <option>Benefit</option>
                @else 
                <option>Benefit</option>
                <option>Cost</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="bobot">Bobot:</label>
            <input name="bobot" type="number" class="form-control" id="bobot" value="{{$detailkriteria->bobot}}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>

  </div>
</div>
@endforeach
@endsection
