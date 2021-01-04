@extends('wo_admin.wo_admin')
@section('content')
@if(session('afterAksi'))
    @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('msg') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('msg') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endif
<div class="row mb-5">
    <div class="col-md-6">
        <a href="{{route('wotambahPaket')}}">
            <button class="btn btn-success">Tambah Paket</button>
        </a>
    </div>
</div>
<table class="table" id="table-paket">
    <thead>
        <tr>
            <td>Nama Paket</td>
            <td>Harga Paket</td>
            <td>Gambar Paket</td>
            <td>aksi</td>
        </tr>
        @foreach($datas as $data)
        <tr>
            <td>{{ $data->nama_paket }}</td>
            <td>{{ $data->harga_paket }}</td>
            <td>
                <button type="button" onclick="getData({{ json_encode($data->gambar_paket) }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Lihat Gambar Paket
                </button>
                <!-- <img width="200" src="{{url('img/fotoUser')}}/{{$data->gambar_paket}}" alt=""> -->
            </td>
            <td>
                <a href="{{ route('tambahLayananWo', $data->id_paket) }}">
                    <button class="btn btn-primary">Tambah Layanan</button>
                </a>
                <a href="{{ route('detailPaketWo', $data->id_paket) }}">
                    <button class="btn btn-primary">Lihat Detail</button>
                </a>
                <a href="{{ route('updatePaketVendor', $data->id_paket) }}">
                    <button class="btn btn-primary">Edit</button>
                </a>
                <a href="{{ route('deletePaketWo', $data->id_paket) }}">
                    <button class="btn btn-danger" onclick="return konfirmasi()">Delete</button>
                </a>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img width="100" src="" id="gambarKTP" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    function getData (data) {
        console.log(data)
        $('#gambarKTP').attr("src", "{!!  url('img/fotoUser/" + data +"') !!}")
    }
</script>
{{ $datas->links() }}

@endsection
