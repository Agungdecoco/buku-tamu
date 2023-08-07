@extends('layouts.layout-guest')

@section('section')
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <div class="container mt-1" style="width: 200%;">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session()->has('failed'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card body shadow rounded" style="left: 2%;">
                    <div class="card-body border border-secondary" style="background-color: #DCD6F7">
                        <div class="consultant-image mt-3 pb-3 mb-3 d-flex justify-content-evenly">
                            @foreach ($consultants as $consultant)
                                <div class="card-img-top"
                                    style="display: block; max-width: 100%; height: auto; width: 200px;">
                                    <h4>Konsultan Yang Aktif</h4>
                                    <img src="/assets/dist/img/avatar.png" class="img-circle elevation-2"
                                        style="max-width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;"
                                        alt="consultant Image" width="106">
                                    <figcaption style="text-align: center">{{ $consultant->nama_konsultan }}</figcaption>
                                </div>
                            @endforeach

                        </div>
                        <a href="{{ route('guest-create') }}" class="btn btn-md mb-3 text-light"
                            style="background-color: #000957">AJUKAN JADWAL</a>
                        <table class="table table-bordered"
                            style="border-radius: 10px; background-color: #000957; color: white;">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">NO</th>
                                    <th class="text-center" scope="col">TANGGAL KONSULTASI</th>
                                    <th class="text-center" scope="col">SESI KONSULTASI</th>
                                    <th class="text-center" scope="col">KONSULTAN</th>
                                    <th class="text-center" scope="col">TIPE KONSULTASI</th>
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
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('guest-queue-del', $queue->id) }}" method="POST">
                                                <a class="btn btn-sm" style="background-color: #DCD6F7"
                                                    href="{{ route('guest-queue-show', $queue->id) }}">DETAIL</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="btn" <?php if ($queue->tgl_konsultasi <= date('Y-m-d') ){ ?> disabled
                                                    <?php } ?> class="btn btn-sm"
                                                    style="background-color: #DCD6F7">HAPUS</button>
                                            </form>
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
