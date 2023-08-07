@extends('layouts.layout-admin')
@section('container')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="width: 100%; background-color: #FDE4D0">
                        <div class="card-header">
                            {{-- Isinya header --}}
                            <a href="{{ route('admin-export') }}" class="btn btn-md mb-3"
                                style="background-color: #1C1A30; color: #FDE4D0"><i
                                    class="fas fa-file-excel mr-2"></i>Export Excel</a>
                        </div>

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
                                        <th class="text-center" scope="col">TOPIK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $num = 1;
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
                                            <td>{{ $queue->topik }}</td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $queues->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
