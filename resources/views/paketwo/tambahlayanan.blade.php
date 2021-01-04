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
    <div class="col-md-12">
        Ajukan Permintaan Kerjasama Dengan Vendor
    </div>
    <div class="col-md-12">
        <a href="{{ route('dataPaketWo') }}">
            <button class="btn btn-warning">Back</button>
        </a>
    </div>
</div>
<table class="table" id="table-vendor">
    <thead>
        <tr>
            <td>Nama</td>
            <td>Detail</td>
            <td>Harga</td>
            <td>Vendor</td>
            <td>Gambar</td>
            <td>Aksi</td>
        </tr>

        @foreach($datas as $data)
        <tr>
            <td>{{ $data->nama_layanan }}</td>
            <td>{{ $data->detail_layanan }}</td>
            <td>Rp. {{ $data->harga_layanan }},-</td>
            <td>
                @if($data->id === auth()->user()->id)
                Anda Sendiri
                @else
                {{ $data->name }}
                @endif
            </td>
            <td>
                <button type="button" onclick="getData({{ json_encode($data->gambar_layanan) }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Lihat Gambar User
                </button>
            <!-- <img width="200" src="{{url('img/fotoUser')}}/{{$data->gambar_layanan}}" alt=""> -->
            </td>
            <td>
                <a href="{{ route('tambahLayananKePaketWo', ['idPaket' => $idPaket, 'idLayanan'=> $data->id_layanan]) }}">
                    <button class="btn btn-primary">Tambahkan Ke Paket</button>
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
