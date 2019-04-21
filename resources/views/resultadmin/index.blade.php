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

                    <h2>Data Cribs</h2>      
                    <br/>
                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach($kriteria as $detailkriteria)
                                <th>{{$detailkriteria->nama}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=0)
                        @foreach($alternatif as $detailalternatif)
                        @php($deatils = Detail::detail($detailalternatif->id))
                        <tr>
                            <td>{{$detailalternatif->nama}}</td>
                            @foreach ($deatils as $detail)
                                <td>{{$detail->nilai}}</td>
                            @endforeach
                            @php($i++)
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <br/>
                    <br/>
                   

                    <h2>Data Normalisasi</h2>      
                    <br/>
                    <br/>
                    <center>
                    @foreach($kriteria as $detailkriteria)
                    @if($detailkriteria->atribut == "Benefit")
                    <p>{{$detailkriteria->nama.' = Max = '.SPK::minormax($detailkriteria->id)}}</p>
                    @else
                    <p>{{$detailkriteria->nama.' = Min = '.SPK::minormax($detailkriteria->id)}}</p>
                    
                    @endif
                    @endforeach
                    </center>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach($kriteria as $detailkriteria)
                                <th>{{$detailkriteria->nama}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=0)
                        @foreach($alternatif as $detailalternatif)
                        @php($deatils = Detail::detail($detailalternatif->id))
                        <tr>
                            <td>{{$detailalternatif->nama}}</td>
                            @foreach ($deatils as $detail)
                                @if($detail->atribut == "Benefit")

                                    <td>{{$detail->nilai}}/{{SPK::minormax($detail->kriteriaid)}}</td>
                                @else
                                    <td>{{SPK::minormax($detail->kriteriaid)}}/{{$detail->nilai}}</td>

                                @endif
                            @endforeach
                            @php($i++)
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <br/>
                    <br/>



                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach($kriteria as $detailkriteria)
                                <th>{{$detailkriteria->nama}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=0)
                        @foreach($alternatif as $detailalternatif)
                        @php($deatils = Detail::detail($detailalternatif->id))
                        <tr>
                            <td>{{$detailalternatif->nama}}</td>
                            @foreach ($deatils as $detail)
                                @if($detail->atribut == "Benefit")

                                <td>{{$detail->nilai/SPK::minormax($detail->kriteriaid)}}</td>
                                @else
                                <td>{{SPK::minormax($detail->kriteriaid)/$detail->nilai}}</td>

                                @endif
                            @endforeach
                            @php($i++)
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <br/>
                    <br/>

                    <h2>Data Perangkingan</h2>      
                    <br/>
                    <center>
                    @foreach ($kriteria as $detailkriteria)
                        <p>{{$detailkriteria->nama}} = {{$detailkriteria->bobot}}</p>
                    @endforeach
                    </center>
                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach($kriteria as $detailkriteria)
                                <th>{{$detailkriteria->nama}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=0)
                        @foreach($alternatif as $detailalternatif)
                        @php($deatils = Detail::detail($detailalternatif->id))
                        <tr>
                            <td>{{$detailalternatif->nama}}</td>
                            @foreach ($deatils as $detail)
                                @if($detail->atribut == "Benefit")

                                <td>{{$detail->nilai/SPK::minormax($detail->kriteriaid)}}*{{$detail->bobot}}</td>
                                @else
                                <td>{{SPK::minormax($detail->kriteriaid)/$detail->nilai}}*{{$detail->bobot}}</td>

                                @endif
                            @endforeach
                            @php($i++)
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach($kriteria as $detailkriteria)
                                <th>{{$detailkriteria->nama}}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=0)
                        @php($arr = array())
                        @foreach($alternatif as $detailalternatif)
                        @php($deatils = Detail::detail($detailalternatif->id))
                        <tr>
                            <td>{{$detailalternatif->nama}}</td>
                            @foreach ($deatils as $detail)
                                @if($detail->atribut == "Benefit")

                                <td>{{$detail->nilai/SPK::minormax($detail->kriteriaid)*$detail->bobot}}</td>
                                @php ($result = $result + ($detail->nilai/SPK::minormax($detail->kriteriaid)*$detail->bobot))
                                @else
                                <td>{{SPK::minormax($detail->kriteriaid)/$detail->nilai*$detail->bobot}}</td>
                                @php ($result = $result + ($detail->nilai/SPK::minormax($detail->kriteriaid)*$detail->bobot))
                                @endif
                            @endforeach
                            @php($i++)
                            <td>{{SPK::calculate($detailalternatif->id)}}</td>
                            @php($ar[] = array("id" => $detailalternatif->id,"nilai" => SPK::calculate($detailalternatif->id)))
                            
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br/>
                    <h2>Hasil Perangkingan</h2>      
                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Nama</th>                         
                            <th>Nilai</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                            @php($i=1)
                            @foreach($winner as $detailwinner)
                            <tr>
                            <td>{{$detailwinner->nama}}</td>

                            <td>{{$detailwinner->nilai}}</td>
                            <td>Peringkat {{$i}}</td>
                            </tr>
                            @php($i++)
                            @endforeach
                        
                        
                        </tbody>
                    </table>

                    <center><p>Berdasarkan perhitungan menggunakan metode saw maka berikut peringkat 5 besar</p></center>

                    <h2>Peringkat 5 Besar</h2>      
                    <br/>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th>Nama</th>                         
                            <th>Nilai</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                            @php($i=1)
                            @foreach($fivetop as $detailwinner)
                            <tr>
                            <td>{{$detailwinner->nama}}</td>

                            <td>{{$detailwinner->nilai}}</td>
                            <td>Peringkat {{$i}}</td>
                            </tr>
                            @php($i++)
                            @endforeach
                        
                        
                        </tbody>
                    </table>

                    <center>
                    </center>
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
      <form method="post" action="{{url('admin/alternatif')}}">
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
