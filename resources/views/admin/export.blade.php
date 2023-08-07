<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal Konsultasi</th>
        <th>Sesi Konsultasi</th>
        <th>Nama Tamu</th>
        <th>NIP Tamu</th>
        <th>Nama Konsultan</th>
        <th>NIP Konsultan</th>
        <th>Topik</th>
        <th>Tipe Konsultasi</th>
        <th>Ruang</th>
        <th>Anggota 1</th>
        <th>Anggota 2</th>
        <th>Anggota 3</th>
    </tr>
    </thead>
    <tbody>
        @php
            $num = 1;
         @endphp
    @foreach($data as $queue)
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
            <td>{{ $queue->guests->nama_tamu }}</td>
            <td>{{ $queue->guests_nip }}</td>
            <td>{{ $queue->consultants_nip }}</td>
            <td>{{ $queue->topik }}</td>
            <td>{{ $queue->tipe_konsultasi }}</td>
            <td>{{ $queue->ruang }}</td>
            <td>{{ $queue->anggota1 }}</td>
            <td>{{ $queue->anggota2 }}</td>
            <td>{{ $queue->anggota3 }}</td>
        </tr>
    @endforeach
    </tbody>
</table>