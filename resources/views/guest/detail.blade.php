@extends('layouts.layout-guest')

@section('section')

    <div class=" container mt-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="card body shadow rounded" style="width: 150%; left: 29%;">
                    <div class="card-body" style="background-color: #DCD6F7">
                        <div class="card-header" style="background-color: #DCD6F7">
                            <ul class="nav justify-content-center">
                                <h1>Detail Pengajuan</h1>
                            </ul>
                            <a class="btn text-light" style="background-color: #000957" href="{{ route('guest-home') }}">Kembali</a>
                        </div>
                        @foreach ($queues as $queue)
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="tgl_konsultasi" class="form-label"><b>Tanggal Konsultasi</b></label>
                                    <input class="form-control" id="tgl_konsultasi" name="tgl_konsultasi"
                                        value="{{ $queue->tgl_konsultasi }}" readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nama_konsultan" class="form-label"><b>Konsultan</b></label>
                                    <input class="form-control" id="nama_konsultan" name="nama_konsultasi"
                                        value="{{ $queue->consultants->nama_konsultan }}" readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="tlp_konsultan" class="form-label"><b>No. Telepon Konsultan </b></label>
                                    <input class="form-control" id="tlp_konsultan" name="tlp_konsultan"
                                        value="{{ $queue->consultants->tlp_konsultan }}" readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="tipe_konsultasi" class="form-label"><b>Tipe Konsultasi</b></label>
                                    <input class="form-control" id="tipe_konsultasi" name="tipe_konsultasi"
                                        value="{{ $queue->tipe_konsultasi }}" readonly>
                                </div>
                            </div>

                            @if ($queue->sesi == 'pagi1')
                                @php
                                    $sesi = '09.00 - 10.30';
                                @endphp
                            @elseif ($queue->sesi == 'pagi2')
                                @php
                                    $sesi = '10.30 - 12.00';
                                @endphp
                            @elseif ($queue->sesi == 'siang')
                                @php
                                    $sesi = '13.00 - 14.30';
                                @endphp
                            @endif
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="sesi" class="form-label"><b>Sesi Konsultasi</b></label>
                                    <input class="form-control" id="sesi" name="sesi" value="{{ $sesi }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="ruang" class="form-label"><b>Ruang</b></label>
                                    <input class="form-control" id="ruang" name="ruang" value="{{ $queue->ruang }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="topik" class="form-label"><b>Topik</b></label>
                                    <input class="form-control" id="topik" name="topik" value="{{ $queue->topik }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="anggota1" class="form-label"><b>Anggota 1</b></label>
                                    <input class="form-control" id="anggota1" name="anggota1"
                                        value="{{ $queue->anggota1 }}" readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="anggota2" class="form-label"><b>Anggota 2</b></label>
                                    <input class="form-control" id="anggota2" name="anggota2"
                                        value="{{ $queue->anggota2 }}" readonly>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="anggota3" class="form-label"><b>Anggota 3</b></label>
                                    <input class="form-control" id="anggota3" name="anggota3"
                                        value="{{ $queue->anggota3 }}" readonly>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
