@extends('layouts.layout-guest')

@section('section')
    <div class=" container mt-3 mx-auto text-center">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="card body shadow rounded" style="width: 150%; left: 29%;">
                    <div class="card-body border border-secondary" style="background-color: #DCD6F7">
                        <div class="card-header">
                            <ul class="nav justify-content-center">
                                <h1>Profile</h1>
                            </ul>
                        </div>
                        
                        <div class="foto-profil-guest">
                            <style>
                                {
                            margin-left: auto;
                            margin-right: auto;
                            display: block;
                            width: 200px
                        }
                            </style>
                            <br>
                            <img src="{{ url('/user_file/' . auth()->user()->guest->foto) }}" class="img-circle elevation-2"
                            alt="Foto Profil Guest" width="300">
                        </div>
                        <br>

                        <form action="{{ route('foto-upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-horizontal">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Foto Anda</label>
                                    <input class="form-control" type="file" id="formFile" name='foto'>
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="Simpan" class="btn" style="background-color:#000957;color:white;">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
