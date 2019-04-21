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

                    <h2>Data Alternatif</h2>      
                    <button type="button" data-toggle="modal" data-target="#myModal" class="col-lg-2 btn btn-primary pull-right">Tambah</button>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Alternatif</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('alternatif')}}">
        <div class="form-group">
            <label for="nama">Nama :</label>
            <input name="nama" type="text" class="form-control" id="nama">
            {{csrf_field()}}
        </div>
        <div class="form-group">
            <label for="jkel">Jenis Kelamin:</label>
            <select class="form-control" id="jkel" name="jkel">
                <option>Laki-laki</option>
                <option>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
        @foreach ($kriteria as $detailkriteria)
        @php ($range = Range::getlist($detailkriteria->id))
        <div class="form-group">
            <label for="{{$detailkriteria->nama}}">{{$detailkriteria->nama}}:</label>
            <input type="hidden" class="form-control" value="{{$detailkriteria->id}}" id="alamat" name="idkriteria[]" required>
            <select class="form-control" id="jkel" name="nilai[]" required>
            @foreach ($range as $rangedetail)
                <option value="{{$rangedetail->nilai}}">{{$rangedetail->keterangan}}</option>
                <!--<input type="text" class="form-control" id="{{$detailkriteria->nama}}" name="{{$detailkriteria->nama}}">-->
            @endforeach
            </select>
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      
    </div>

  </div>
</div>
@endsection
