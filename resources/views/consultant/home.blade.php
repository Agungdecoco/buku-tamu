@extends('layouts.layout-consultant')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="width: 205%;">

                        <div class="card-header" style="background-color: #E2EDDF">
                            <ul class="nav left">
                                <li class="nav-item">
                                    <form class="form" method="get" action="{{ route('search') }}">
                                        <div class="form-group w-100 mb-3">
                                            <label for="search" class="d-block mr-2">Pencarian</label>
                                            <select class="form-select form-control-sm d-inline mb-1" name="filter"
                                                style="width: 165px">
                                                <option selected value="null">Pilih tipe pencarian...</option>
                                                <option value="nip">NIP</option>
                                                <option value="nama">Nama</option>
                                            </select>
                                            <input type="text" name="search" class="form-control w-30 d-inline" id="search"
                                                placeholder="Masukkan keyword" {{ request('search') }}
                                                style="width: 165px">
                                            <button type="submit" class="btn mb-2"
                                                style="background-color: #1F441E; color: #E2EDDF">Cari</button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body" style="background-color: #E2EDDF">
                            @if (session()->has('error'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <table class="table table-bordered table-striped"
                                style="border-radius: 10px; background-color: #83A17D; color: black;">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">NO</th>
                                        <th class="text-center" scope="col">TANGGAL KONSULTASI</th>
                                        <th class="text-center" scope="col">SESI KONSULTASI</th>
                                        <th class="text-center" scope="col">KONSULTAN</th>
                                        <th class="text-center" scope="col">TIPE KONSULTASI</th>
                                        <th class="text-center" scope="col">TOPIK</th>
                                        <th class="text-center" scope="col">ACTION</th>
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
                                            @endif
                                            <td>{{ $sesi }}</td>
                                            <td>{{ $queue->consultants->nama_konsultan }}</td>
                                            <td>{{ $queue->tipe_konsultasi }}</td>
                                            <td>{{ $queue->topik }}</td>

                                            <td class="text-center">
                                                <a class="btn btn-sm" style="background-color: #1F441E; color: #E2EDDF"
                                                    href="{{ route('consultant-queue-show', $queue->id) }}">DETAIL</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $queues->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
