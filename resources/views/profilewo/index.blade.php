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
<div class="row">
    <div class="col-md-5">
        <img style="width:400px;height:550px;" class="img-responsive " src="{{ url('img/fotoUser') }}/{{auth()->user()->gambar}}" alt="">
    </div>
    <div class="col-md-6">
        <h1 class="mb-5" style="margin-top:130px;font-family:verdana;">
           <b> My Profile</b>
        </h1>
       <b>
            <div class="row">
                <div class="col-md-3">
                    <h5>Nama:</h5>
                </div>
                <div class="col-md-6">
                    <h5>{{ auth()->user()->name }}</h5>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-3">
                    <h5>Email:</h5>
                </div>
                <div class="col-md-6">
                    <h5>{{ auth()->user()->email }}</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <h5>Alamat:</h5>
                </div>
                <div class="col-md-6">
                    <h5>{{ auth()->user()->alamat }}</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <h5>No Telpon:</h5>
                </div>
                <div class="col-md-6">
                    <h5>{{ auth()->user()->no_telp }}</h5>
                </div>
            </div>
       </b>
    </div>
</div>
@endsection
