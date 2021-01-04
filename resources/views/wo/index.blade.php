@extends('admin.admin')
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
        <a href="{{route('inputWo')}}">
            <button class="btn btn-success">Tambah</button>
        </a>
        
    </div>
</div>
<table class="table" id="table-user">
    <thead>
        <tr>
            <!-- <td>Username</td> -->
            <td>Nama Lengkap</td>
            <td>Email</td>
            <td>No Telp</td>
            <td>Alamat</td>
            <td>Gambar User</td>
            <td>Gambar KTP</td>
            <td>Aksi</td>
        </tr>

        @foreach($datas as $data)
        <tr>
            <!-- <td>{{ $data->username }}</td> -->
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->no_telp }}</td>
            <td>{{ $data->alamat }}</td>
            <td>
                <button type="button" onclick="getData({{ json_encode($data->gambar) }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Lihat Gambar User
                </button>
                <!-- <img width="100" src="{{ url('img/fotoUser/') }}/{{ $data->gambar }}" alt=""> -->
            </td>
            <td>
                <button type="button" onclick="getData({{ json_encode($data->foto) }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Lihat Gambar KTP
                </button>
                <!-- <img width="100" src="{{ url('img/fotoUser/') }}/{{ $data->foto }}" alt=""> -->
            </td>
            <td>

                <a href="{{ route('formEditWo', $data->id) }}">
                        <button class="btn btn-primary">Edit</button>
                </a>
        
                <a href="{{ route('deleteWo', $data->id) }}">
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
