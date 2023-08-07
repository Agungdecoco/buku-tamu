@extends('layouts.layout-admin')
@section('container')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="width: 100%; background-color: #FDE4D0">

                        <div class="card-body" style="background-color: #FDE4D0">
                            <table class="table table-bordered table-striped"
                                style="border-radius: 10px; background-color: #F8F6F7; color: black;">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">NO</th>
                                        <th class="text-center" scope="col">TANGGAL KONSULTASI</th>
                                        <th class="text-center" scope="col">SESI KONSULTASI</th>
                                        <th class="text-center" scope="col">NAMA TAMU</th>
                                        <th class="text-center" scope="col">KONSULTAN</th>
                                        <th class="text-center" scope="col">TIPE KONSULTASI</th>
                                        <th class="text-center" scope="col">ANGGOTA</th>
                                        <th class="text-center" scope="col">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $num = $queues->perPage() * ($queues->currentPage() - 1) + 1;
                                    @endphp
                                    @forelse ($queues as $queue)
                                        <tr>
                                            <td>{{ $num++ }}</td>
                                            <td>{{ $queue->tgl_konsultasi }}</td>
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
                                            @else
                                                @php
                                                    $sesi = 'kosong';
                                                @endphp
                                            @endif
                                            <td>{{ $sesi }}</td>
                                            <td>{{ $queue->guests->nama_tamu }}</td>
                                            <td>{{ $queue->consultants->nama_konsultan }}</td>
                                            <td>{{ $queue->tipe_konsultasi }}</td>
                                            {{-- <td>{{ $queue->ruang }}</td> --}}
                                            <td>
                                                <ul>{{ $queue->anggota1 }}</ul>
                                                <ul>{{ $queue->anggota2 }}</ul>
                                                <ul>{{ $queue->anggota3 }}</ul>
                                            </td>
                                            @if ($queue->tgl_konsultasi)
                                                @php
                                                    $currentDate = now();
                                                    $targetDate = \Carbon\Carbon::parse($queue->tgl_konsultasi);
                                                    $status = '';
                                                    
                                                    if ($targetDate->isPast()) {
                                                        $status = 'done';
                                                    } elseif ($targetDate->isSameDay($currentDate)) {
                                                        $status = 'open';
                                                    } elseif ($targetDate->isYesterday() || $targetDate->isFuture()) {
                                                        $status = 'progress';
                                                    } else {
                                                        $status = 'unknown';
                                                    }
                                                @endphp
                                            @endif
                                            <td>{{ $status }}</td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col d-flex">
                            <a href="{{ $queues->previousPageUrl() }}" class="m-1">
                                Previous
                            </a>
                            @for ($i = 0; $i <= $queues->lastPage(); $i++)
                                <!-- a Tag for another page -->
                                <a href="{{ $queues->url($i) }}" class="m-1">{{ $i + 1 }}</a>
                            @endfor
                            <a href="{{ $queues->nextPageUrl() }}" class="m-1">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
