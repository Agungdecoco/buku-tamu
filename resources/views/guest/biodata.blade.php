@extends('layouts.layout-guest')

@section('section')

    <div class=" container mt-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="card body shadow rounded" style="width: 150%; left: 29%;">
                    <div class="card-body border border-secondary" style="background-color: #DCD6F7">
                        <div class="card-header">
                            <ul class="nav justify-content-center">
                                <h1>Biodata</h1>
                            </ul>
                        </div>
                        <br>
                        @foreach ($guests as $guest)
                        <form action="{{ route('biodata-update') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nip" placeholder="NIP" value="{{ $guest->nip }}" readonly>
                                    </div>
                                </div>                               
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nama" id="name" placeholder="Name" value="{{ $guest->nama_tamu }}">
                                    </div>
                                </div>                               
                            </div>

                            <div class="form-group row">
                                <label for="notlp" class="col-sm-2 col-form-label">No Tlp</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tlp" id="notlp" placeholder="No Tlp" value="{{ $guest->tlp_tamu }}">
                                    </div>
                                </div>                             
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ auth()->user()->email }}">
                                    </div>
                                </div>                               
                            </div>

                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="{{ $guest->jabatan_tamu }}">
                                    </div>
                                </div>                               
                            </div>

                            <div class="form-group row">
                                <label for="instansi" class="col-sm-2 col-form-label">Instansi</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="instansi" id="instansi" placeholder="Instansi" value="{{ $guest->instansi }}">
                                    </div>
                                </div>                                
                            </div>

                            <div class="text-center">
                                <input type="submit" class="btn text-light" style="background-color: #000957">
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

@endsection
