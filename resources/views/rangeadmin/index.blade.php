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
                <div class="card-header">Data Range</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Data Range</h2>      
                    <button type="button" data-toggle="modal" data-target="#myModal" class="col-lg-2 btn btn-primary pull-right">Tambah</button>
                    <br/>
                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Nilai</th>
                            <th>Kriteria</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($range as $detailrange)
                        <tr>
                            <td>{{$detailrange->keterangan}}</td>
                            <td>{{$detailrange->nilai}}</td>
                            <td>{{$detailrange->nama}}</td>
                            <td>
									<button type="button" data-toggle="modal" data-target="#modal{{$detailrange->idrange}}" class="btn btn-info btn-xs">Edit</button>

									<button type="button" onclick="event.preventDefault();
                                                     document.getElementById('delete{{$detailrange->idrange}}-form').submit();" class="btn btn-danger btn-xs btn-delete" value="1">Hapus</button>
                                    <form id="delete{{$detailrange->idrange}}-form" action="{{ url('admin/range/') }}/{{$detailrange->idrange}}" method="POST" style="display: none;">
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
        <h4 class="modal-title">Tambah Range</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('admin/range')}}">
        <div class="form-group">
            <label for="kriteria">Kriteria:</label>
            <select class="form-control" id="kriteria" name="kriteriaid">
                @foreach  ($kriteria as $detailkriteria)
                    <option value="{{$detailkriteria->id}}">{{$detailkriteria->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="namarange">Keterangan:</label>
            <input name="keterangan" type="text" class="form-control" id="keterangan">
            {{csrf_field()}}
        </div>
        <div class="form-group">
            <label for="nilai">Nilai:</label>
            <input name="nilai" type="number" class="form-control" id="nilai">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

  </div>
</div>
@foreach ($range as $detailrange)
<!-- Modal -->
<div id="modal{{$detailrange->idrange}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Range</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('admin/range/'.$detailrange->idrange)}}">
        <div class="form-group">
            <label for="atribut">Kriteria:</label>
            <select class="form-control" id="kriteria" name="kriteriaid">               
                @foreach  ($kriteria as $detailkriteria)
                        <option value="{{$detailkriteria->id}}">{{$detailkriteria->nama}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="namakriteria">Keterangan:</label>
            <input name="nama" type="text" class="form-control" id="namakriteria" value="{{$detailrange->keterangan}}">
            {{csrf_field()}}
            {{ method_field('PUT')}}  
        </div>
        <div class="form-group">
            <label for="nilai">Bobot:</label>
            <input name="nilai" type="number" class="form-control" id="bobot" value="{{$detailrange->nilai}}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>

  </div>
</div>
@endforeach
@endsection
