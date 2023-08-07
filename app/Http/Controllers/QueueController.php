<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Guest;
use App\Models\Queue;
use App\Models\Consultant;
use App\Exports\QueueExport;
use App\Imports\QueueImport;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreQueueRequest;
use App\Http\Requests\UpdateQueueRequest;
use PDF;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultants = Consultant::where('isActive', 1)->get();
        $guests = Guest::all();
        // dd($consultants);
        $auth_user = auth()->user()->guest->nip;
        $date = date('Y-m-d');
        $queues = Queue::where('guests_nip', $auth_user)->where('tgl_konsultasi', '>=', date('Y-m-d'))->latest()->paginate(5);
        return view('guest.home', compact('queues', 'consultants'))->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('consultant.home', compact('queues', 'guests'));
    }

    public function indexConsultant()
    {
        // $consultants = Consultant::all();
        $guests = Guest::all();
        $users = User::all();
        // dd($consultants);
        $queues = Queue::where('tgl_konsultasi', '>=', date('Y-m-d'))->latest()->paginate(5);
        return view('consultant.home', compact('queues', 'guests', 'users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexAdmin()
    {
        $queues_total = Queue::count('id');
        $consultants = Consultant::all();
        $queues = Queue::select('consultants_nip', DB::raw("count('id') as total"))
            ->groupby('consultants_nip')
            ->get();
        $label = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
        $tahun_awal = DB::table('queues')->min(DB::raw('YEAR(tgl_konsultasi)'));
        $tahun_akhir = DB::table('queues')->max(DB::raw('YEAR(tgl_konsultasi)'));
        // for ($tahun = $tahun_awal; $tahun <= $tahun_akhir; $tahun++) {
        //     $jumlah_tamu[$tahun] = [];
        //     $results = Queue::whereYear('tgl_konsultasi', $tahun)
        //         ->groupBy('consultants_nip')
        //         ->selectRaw('consultants_nip')
        //         ->get();
        //     foreach ($results as $row) {
        //         $nip = $row->consultants_nip;

        //         $jumlah_tamu[$tahun][$nip] = [];
        //         for ($bulan = 1; $bulan < 13; $bulan++) {
        //             $chartuser = collect(DB::SELECT("SELECT count(id) AS jumlah from queues where year(tgl_konsultasi)='$tahun' and consultants_nip='$nip' and month(tgl_konsultasi)='$bulan'"))->first();
        //             $jumlah_tamu[$tahun][$nip][] = $chartuser->jumlah;
        //         }
        //     }
        // }
        for ($tahun = $tahun_awal; $tahun <= $tahun_akhir; $tahun++) {
            $jumlah_tamu[$tahun] = [];
            for ($bulan = 1; $bulan < 13; $bulan++) {
                $chartQueueDone = collect(DB::SELECT("SELECT count(id) AS jumlah from queues where tgl_konsultasi > now() and year(tgl_konsultasi)='$tahun' and month(tgl_konsultasi)='$bulan'"))->first();
                $chartQueueProgress = collect(DB::SELECT("SELECT count(id) AS jumlah from queues where tgl_konsultasi < now() and year(tgl_konsultasi)='$tahun' and month(tgl_konsultasi)='$bulan'"))->first();
                $chartQueueOpen = collect(DB::SELECT("SELECT count(id) AS jumlah from queues where tgl_konsultasi = now() and year(tgl_konsultasi)='$tahun' and month(tgl_konsultasi)='$bulan'"))->first();
                $jumlah_konsultasi_selesai[$tahun][] = $chartQueueDone->jumlah;
                $jumlah_konsultasi_proses[$tahun][] = $chartQueueProgress->jumlah;
                $jumlah_konsultasi_dibuka[$tahun][] = $chartQueueOpen->jumlah;
            }
        }

        return view('admin.home', compact('queues', 'consultants', 'queues_total', 'label', 'jumlah_konsultasi_selesai', 'jumlah_konsultasi_dibuka', 'jumlah_konsultasi_proses'));
    }

    public function requestAdmin()
    {
        $queues = Queue::where('tgl_konsultasi', '>=', date('Y-m-d'))->latest()->paginate(5);
        $consultants = Consultant::all();
        $guests = Guest::all();

        return view('admin.request', compact('queues', 'guests', 'consultants'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function adminUserMenu()
    {
        // $consultants = Consultant::all();
        $guests = Guest::all();
        $users = User::all();
        $currentDate = Carbon::now();
        $queues = Queue::latest()->paginate(5);
        return view('admin.user-menu', compact('queues', 'guests', 'users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function history()
    {
        $queues = Queue::latest()->paginate(5);
        $consultants = Consultant::all();
        $guests = Guest::all();
        return view('admin.history', compact('queues', 'guests', 'consultants'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consultants = Consultant::where('isActive', 1)->get();
        // dd($consultants);
        $queues = Queue::latest()->paginate(5);
        return view('guest.reserve', compact('queues', 'consultants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQueueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room = null;
        $link_gmeet = 'https://meet.google.com/npf-aivz-dhj';
        // dd($request->all());

        if ($request->tipe_konsultasi === 'online') {
            $room = $link_gmeet;
        } else if ($request->tipe_konsultasi === 'offline') {
            $room = 'ruang 1';
        }

        $date = Carbon::parse($request->tgl_konsultasi)->format('y-m-d');

        $validate_consultant = DB::table('queues')->where([
            ['tgl_konsultasi', '=', $date],
            ['sesi', '=', $request->sesi],
            ['consultants_nip', '=', $request->consultants_nip]
        ])->count('consultants_nip');
        $validate_room = DB::table('queues')->where([
            ['tgl_konsultasi', '=', $date],
            ['sesi', '=', $request->sesi],
            ['ruang', '=', $room]
        ])->count('ruang');
        $validate_time = DB::table('queues')->where([
            ['tgl_konsultasi', '=', $date],
            ['sesi', '=', $request->sesi]
        ])->count('sesi');
        $validate_date = DB::table('queues')->where([
            ['tgl_konsultasi', '=', $date]
        ])->count('tgl_konsultasi');
        $count_consultants = DB::table('queues')->where([
            ['tgl_konsultasi', '=', $date],
            ['consultants_nip', '=', $request->consultants_nip]
        ])->count('consultants_nip');

        if ($validate_date > 0) {
            if ($count_consultants >= 2) {
                return redirect()->route('guest-create')->with('failed', 'Konsultan sedang sibuk, mohon pilih konsultan lain.');
            } elseif ($count_consultants < 2) {
                if ($validate_time > 0) {
                    if ($validate_consultant > 0 && $validate_room > 0) {
                        return redirect()->route('guest-create')->with('failed', 'Sesi penuh, mohon pilih sesi lain.');
                    } elseif ($validate_consultant == 0 && $validate_room == 0) {
                        Queue::create([
                            'tgl_konsultasi' => $date,
                            'sesi' => $request->sesi,
                            'consultants_nip' => $request->consultants_nip,
                            'guests_nip' => auth()->user()->guest->nip,
                            'topik' => $request->topik,
                            'tipe_konsultasi' => $request->tipe_konsultasi,
                            'ruang' => $room,
                            'anggota1' => $request->anggota1,
                            'anggota2' => $request->anggota2,
                            'anggota3' => $request->anggota3
                        ]);
                        return redirect()->route('guest-home')->with('success', 'Pengajuan berhasil ditambahkan');
                    }
                } elseif ($validate_time == 0) {
                    Queue::create([
                        'tgl_konsultasi' => $date,
                        'sesi' => $request->sesi,
                        'consultants_nip' => $request->consultants_nip,
                        'guests_nip' => auth()->user()->guest->nip,
                        'topik' => $request->topik,
                        'tipe_konsultasi' => $request->tipe_konsultasi,
                        'ruang' => $room,
                        'anggota1' => $request->anggota1,
                        'anggota2' => $request->anggota2,
                        'anggota3' => $request->anggota3
                    ]);
                    return redirect()->route('guest-home')->with('success', 'Pengajuan berhasil ditambahkan');
                }
            }
        } elseif ($validate_date == 0) {
            Queue::create([
                'tgl_konsultasi' => $date,
                'sesi' => $request->sesi,
                'consultants_nip' => $request->consultants_nip,
                'guests_nip' => auth()->user()->guest->nip,
                'topik' => $request->topik,
                'tipe_konsultasi' => $request->tipe_konsultasi,
                'ruang' => $room,
                'anggota1' => $request->anggota1,
                'anggota2' => $request->anggota2,
                'anggota3' => $request->anggota3
            ]);
            return redirect()->route('guest-home')->with('success', 'Pengajuan berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $consultants = Consultant::all();
        $guest = Guest::all();
        // dd($consultants);
        $queues = Queue::all()->where('id', $id);
        return view('guest.detail', compact('queues', 'consultants'));
    }

    public function showConsultant($id)
    {
        $consultants = Consultant::all();
        $guests = Guest::all();
        // dd($consultants);
        $queues = Queue::all()->where('id', $id);
        return view('consultant.detail', compact('queues', 'consultants', 'guests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function edit(Queue $queue, $id)
    {
        $consultants = Consultant::all();
        $guests = Guest::all();
        // dd($consultants);
        $queues = Queue::all()->where('id', $id);
        return view('admin.update', compact('queues', 'consultants', 'guests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQueueRequest  $request
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queue $queue)
    {
        DB::table('queues')->where('id', $request->id)->update([
            'ruang' => $request->ruang
        ]);

        $queue->update($request->all());
        return redirect()->route('admin-request')->with('success', 'Pengajuan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        DB::table('queues')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Reserve deleted successfully');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        // DB::table('consultants')->where('nama_konsultan', 'like', ("%" . $keyword . "%"))
        $guests = Guest::all();
        $users = User::all();
        $consultants = Consultant::latest()->where('nama_konsultan', 'like', "%" . $keyword . "%")->get();
        if ($request->filter === 'nip') {
            $queues = Queue::where('consultants_nip', 'like', "%" . $request->search . "%")->paginate(5);
            return view('consultant.home', compact('queues', 'guests', 'users'))->with('i', (request()->input('page', 1) - 1) * 5);
        } elseif ($request->filter === 'nama') {
            if ($consultants->count() == 0) {
                return redirect()->back()->with('error', 'Consultant not found');
            } else {
                $queues = Queue::where('consultants_nip', 'like', "%" . $consultants[0]->nip . "%")->paginate(5);
                return view('consultant.home', compact('queues', 'guests', 'users'))->with('i', (request()->input('page', 1) - 1) * 5);
            }
        } elseif ($request->filter === 'null') {
            return redirect()->route('consultant-home');
        }
    }

    public function handleFilter(Request $request)
    {
        $filters = $request->input('filters');

        $queues = Queue::where(function ($query) use ($filters) {
            foreach ($filters as $index => $filter) {
                if ($index === 0 || $filter['logic'] === 'AND') {
                    if ($filter['category'] === 'tgl_konsultasi') {
                        if ($filter['operator'] === '=') {
                            $query->whereBetween($filter['category'], [$filter['fromDate'], $filter['toDate']]);
                        } else {
                            $query->whereNotBetween($filter['category'], [$filter['fromDate'], $filter['toDate']]);
                        }
                    } else {
                        $query->where($filter['category'], $filter['operator'], $filter['additionalForm']);
                    }
                } elseif ($filter['logic'] === 'OR') {
                    if ($filter['category'] === 'tgl_konsultasi') {
                        if ($filter['operator'] === '=') {
                            $query->orWhereBetween($filter['category'], [$filter['fromDate'], $filter['toDate']]);
                        } else {
                            $query->orWhereNotBetween($filter['category'], [$filter['fromDate'], $filter['toDate']]);
                        }
                    } else {
                        $query->orWhere($filter['category'], $filter['operator'], $filter['additionalForm']);
                    }
                }
            }
        })->latest()->paginate(5);

        $queues->load('guests', 'consultants');

        $updatedQueues = $queues->map(function ($queue, $index) {
            $queue->num = $index + 1;
            $queue->sesi = ($queue->sesi == 'pagi1') ? '09.00 - 10.30' : (($queue->sesi == 'pagi2') ? '10.30 - 12.00' : '13.00 - 14.30');
            $queue->nama_tamu = $queue->guests->nama_tamu;
            $queue->nama_konsultan = $queue->consultants->nama_konsultan;
            return $queue;
        });

        $updatedData = [
            'queues' => $updatedQueues,
        ];

        return response()->json($updatedData);
    }

    public function importQueue(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $data = $request->file('file');

        // membuat nama file unik
        $file = rand() . $data->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $data->move('excel_queue', $file);

        // dd($request->all());
        Excel::import(new QueueImport(), public_path('excel_queue/' . $file), null, \Maatwebsite\Excel\Excel::XLSX);

        return redirect()->back()->with('success', 'File imported successfully.');
    }

    public function exportQueue()
    {
        return Excel::download(new QueueExport, 'Data Konsultasi PDS.xlsx');
    }

    public function exportToPdf()
    {
        $queues_total = Queue::count('id');
        $consultants = Consultant::all();
        $queues = Queue::select('consultants_nip', DB::raw("count('id') as total"))
            ->groupby('consultants_nip')
            ->get();
        $label = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
        $tahun_awal = DB::table('queues')->min(DB::raw('YEAR(tgl_konsultasi)'));
        $tahun_akhir = DB::table('queues')->max(DB::raw('YEAR(tgl_konsultasi)'));
        // for ($tahun = $tahun_awal; $tahun <= $tahun_akhir; $tahun++) {
        //     $jumlah_tamu[$tahun] = [];
        //     $results = Queue::whereYear('tgl_konsultasi', $tahun)
        //         ->groupBy('consultants_nip')
        //         ->selectRaw('consultants_nip')
        //         ->get();
        //     foreach ($results as $row) {
        //         $nip = $row->consultants_nip;

        //         $jumlah_tamu[$tahun][$nip] = [];
        //         for ($bulan = 1; $bulan < 13; $bulan++) {
        //             $chartuser = collect(DB::SELECT("SELECT count(id) AS jumlah from queues where year(tgl_konsultasi)='$tahun' and consultants_nip='$nip' and month(tgl_konsultasi)='$bulan'"))->first();
        //             $jumlah_tamu[$tahun][$nip][] = $chartuser->jumlah;
        //         }
        //     }
        // }
        for ($tahun = $tahun_awal; $tahun <= $tahun_akhir; $tahun++) {
            $jumlah_tamu[$tahun] = [];
            for ($bulan = 1; $bulan < 13; $bulan++) {
                $chartQueueDone = collect(DB::SELECT("SELECT count(id) AS jumlah from queues where tgl_konsultasi > now() and year(tgl_konsultasi)='$tahun' and month(tgl_konsultasi)='$bulan'"))->first();
                $chartQueueProgress = collect(DB::SELECT("SELECT count(id) AS jumlah from queues where tgl_konsultasi < now() and year(tgl_konsultasi)='$tahun' and month(tgl_konsultasi)='$bulan'"))->first();
                $chartQueueOpen = collect(DB::SELECT("SELECT count(id) AS jumlah from queues where tgl_konsultasi = now() and year(tgl_konsultasi)='$tahun' and month(tgl_konsultasi)='$bulan'"))->first();
                $jumlah_konsultasi_selesai[$tahun][] = $chartQueueDone->jumlah;
                $jumlah_konsultasi_proses[$tahun][] = $chartQueueProgress->jumlah;
                $jumlah_konsultasi_dibuka[$tahun][] = $chartQueueOpen->jumlah;
            }
        }

        $pdf = PDF::loadview('admin.dashboard-export', compact('queues', 'consultants', 'queues_total', 'label', 'jumlah_konsultasi_selesai', 'jumlah_konsultasi_dibuka', 'jumlah_konsultasi_proses'))->setOptions(['defaultFont' => 'sans-serif']);

        // Download the PDF
        // return $pdf->download('dashboard.pdf');
        return view('admin.dashboard-export', compact('queues', 'consultants', 'queues_total', 'label', 'jumlah_konsultasi_selesai', 'jumlah_konsultasi_dibuka', 'jumlah_konsultasi_proses'));
    }
}
