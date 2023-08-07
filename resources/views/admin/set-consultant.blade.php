@extends('layouts.layout-admin')

@section('container')
    <div class=" container mt-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="card body shadow rounded" style="width: 100%;">
                    <div class="card-body border border-secondary" style="background-color: #FDE4D0"">
                        <div class="card-header">
                            <ul class="nav justify-content-center">
                                <h1>Status Consultant</h1>
                            </ul>
                        </div>

                        <div class="card-body" style="background-color: #FDE4D0">
                            <table class="table table-bordered table-striped"
                                style="border-radius: 10px; background-color: #F8F6F7; color: black;">
                                <thead>
                                    <tr>
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No. Telepon</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($consultants as $consultant)
                                        <tr>
                                            <td>{{ $consultant->nip }}</td>
                                            <td>{{ $consultant->nama_konsultan }}</td>
                                            <td>{{ $consultant->tlp_konsultan }}</td>
                                            <td>
                                                @livewire('consultant-status', ['model' => $consultant, 'field' => 'isActive'], key($consultant->nip))
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Data not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
