@extends('layouts.layout-admin')

@section('container')
    <div class=" container mt-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="card body shadow rounded" style="width: 100%;">
                    <div class="card-body" style="background-color: #FDE4D0">
                        <div class="card-header">
                            <ul class="nav justify-content-center">
                                <h1>Request</h1>
                            </ul>
                        </div>
                        @foreach ($queues as $queue)
                            <form action="{{ route('admin-request-update') }}" method="POST">
                                {{ csrf_field() }}
                                <div>
                                    <input type="text" name="id" value="{{ $queue->id }}" hidden>
                                </div>

                                <div class="form-group">
                                    <label for="nama_tamu" class="form-label"><b>Nama Tamu</b></label>
                                    <input type="text" class="form-control" id="nama_tamu" name="nama_tamu" readonly
                                        value="{{ $queue->guests->nama_tamu }}">
                                </div>

                                <div class="form-group">
                                    <label for="konsultan" class="form-label"><b>Konsultan</b></label>
                                    <input class="form-control form-control-sm" label=".form-control-sm example"
                                        id="konsultan" name="consultants" readonly
                                        value="{{ $queue->consultants->nama_konsultan }}">
                                </div>

                                <div class="form-group">
                                    <label for="tanggal" class="form-label"><b>Tanggal Konsultasi</b></label>
                                    <input type="text" class="form-control" id="tanggal" name="tgl_konsultasi" readonly
                                        value="{{ $queue->tgl_konsultasi }}">
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
                                <div class="form-group">
                                    <label for="waktu" class="form-label"><b>Sesi Konsultasi</b></label>
                                    <input type="waktu" class="form-control" id="waktu" name="waktu" readonly
                                        value="{{ $queue->sesi }}">
                                </div>

                                <div class="form-group">
                                    <label for="topik" class="form-label"><b>Topik</b></label>
                                    <input type="textarea" class="form-control" id="topik" name="topik" readonly
                                        value="{{ $queue->topik }}">
                                </div>

                                <div class="form-group">
                                    <label for="tipe" class="form-label"><b>Tipe Konsultasi</b></label>
                                    <input class="form-control form-control-sm" label=".form-control-sm example"
                                        name="tipe_konsultasi" readonly value="{{ $queue->tipe_konsultasi }}">
                                </div>

                                <div class="form-group">
                                    @if ($queue->tipe_konsultasi == 'online')
                                        <label for="status" class="form-label"><b>Link</b></label>
                                    @elseif ($queue->tipe_konsultasi == 'offline')
                                        <label for="status" class="form-label"><b>Ruang</b></label>
                                    @endif
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="ruang" name="ruang"
                                            value="{{ $queue->ruang }}">
                                        <a href="#"><i class="fa fa-pencil right"></i></a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn"
                                        style="background-color: #1C1A30; color: #FDE4D0">Submit</button>
                                </div>
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
