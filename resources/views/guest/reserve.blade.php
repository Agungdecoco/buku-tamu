@extends('layouts.layout-guest')

@section('section')

    <div class=" container mt-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="card body shadow rounded" style="width: 150%; left: 29%;">
                    <div class="card-body border border-secondary" style="background-color: #DCD6F7">
                        <div class="card-header">
                            <ul class="nav justify-content-center">
                                <h1>Reserve</h1>
                            </ul>
                            <a class="btn btn-secondary float-left pb-1 mb-1 mt-2 text-light" style="background-color: #000957" href="{{ route('guest-home') }}">
                                Kembali</a>
                        </div>
                        <form action="{{ route('guest-store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="datepicker" class="form-label"><b>Tanggal Konsultasi</b></label>
                                <input type="text" class="form-control" id="datepicker" name="tgl_konsultasi">
                            </div>
                            <div class="form-group">
                                <label for="waktu" class="form-label"><b>Sesi Konsultasi</b></label>
                                <select class="form-control form-control-sm" label=".form-control-sm example" name="sesi">
                                    <option selected>Open this select menu</option>
                                    <option value="pagi1">09.00 - 10.30</option>
                                    <option value="pagi2">10.30 - 12.00</option>
                                    <option value="siang">13.00 - 14.30</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="konsultan" class="form-label"><b>Konsultan</b></label>
                                <select class="form-control form-control-sm" label=".form-control-sm example" id="konsultan"
                                    name="consultants_nip">
                                    <option selected>Open this select menu</option>
                                    @forelse ( $consultants as $consultant )
                                        <option value="{{ $consultant->nip }}">{{ $consultant->nama_konsultan }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="topik" class="form-label"><b>Topik</b></label>
                                <input type="textarea" class="form-control" id="topik" name="topik">
                            </div>
                            <div class="form-group">
                                <label for="tipe" class="form-label"><b>Tipe Konsultasi</b></label>
                                <select class="form-control form-control-sm" label=".form-control-sm example"
                                    name="tipe_konsultasi">
                                    <option selected>Open this select menu</option>
                                    <option value="online">online</option>
                                    <option value="offline">offline</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="anggota1" class="form-label"><b>Anggota 1</b></label>
                                <input type="text" class="form-control" id="anggota1" name="anggota1">
                            </div>
                            <div class="form-group">
                                <label for="anggota2" class="form-label"><b>Anggota 2</b></label>
                                <input type="text" class="form-control" id="anggota2" name="anggota2">
                            </div>
                            <div class="form-group">
                                <label for="anggota3" class="form-label"><b>Anggota 3</b></label>
                                <input type="text" class="form-control" id="anggota3" name="anggota3">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn text-light" style="background-color: #000957">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>            
                @endsection
