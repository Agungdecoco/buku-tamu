<?php

namespace App\Imports;

use App\Models\Guest;
use App\Models\Queue;
use App\Models\Consultant;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QueueImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Lakukan operasi untuk mengisi data ke model atau tabel
            $consultant = Consultant::all();

            $guest = Guest::create([
                'nip' => $row['nip_tamu'] ?? null,
                'users_id' => rand(),
                'nama_tamu' => $row['nama_tamu'] ?? null,
            ]);

            // dd($row);
            Queue::create([
                'tgl_konsultasi' => $row['tanggal_konsultasi'] ?? null,
                'sesi' => $row['sesi_konsultasi'] ?? null,
                'consultants_nip' => $row['nip_konsultan'],
                'guests_nip' => $row['nip_tamu'],
                'topik' => $row['topik'] ?? null,
                'tipe_konsultasi' => $row['tipe_konsultasi'] ?? null,
                'ruang' => $row['ruang'] ?? null,
                'anggota1' => $row['anggota_1'] ?? null,
                'anggota2' => $row['anggota_2'] ?? null,
                'anggota3' => $row['anggota_3'] ?? null
            ]);
        }
    }
}
