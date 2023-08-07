@extends('layouts.layout-admin')
@section('container')
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            width: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        .head-form {
            display: flex;
            justify-content: space-between;
        }

        #closePopupBtn {
            font-size: 20px;
        }

        .close-button {
            position: absolute;
            top: 5px;
            right: 0px;
            width: 20px;
            height: 20px;
            border: none;
            background-color: transparent;
            cursor: pointer;
            outline: none;
        }

        .close-button:before,
        .close-button:after {
            content: '';
            position: absolute;
            top: 5px;
            left: 0px;
            width: 15px;
            height: 2px;
            background-color: #000;
            transition: transform 0.3s;
        }

        .close-button:before {
            transform: rotate(45deg);
        }

        .close-button:after {
            transform: rotate(-45deg);
        }

        .close-button:hover:before,
        .close-button:hover:after {
            background-color: #ff0000;
        }

        .filter-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .filter-margin {
            margin-right: 10px;
        }

        .remove-filter-btn {
            margin-left: 10px;
        }

        #filterContainer .filter-row+.filter-row {
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        #addFilterBtn {
            margin-top: 10px;
            font-size: 14px;
            text-decoration: none;
            color: #000;
        }

        #addFilterBtn:hover {
            color: green;
        }


        .date-range-container {
            display: flex;
            align-items: center;
        }

        .date-range-container input {
            margin-right: 10px;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
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
                <div class="col-11">
                    <div class="card" style="width: 100%;">
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
                                        {{-- <th class="text-center" scope="col">TOPIK</th> --}}
                                        {{-- <th class="text-center" scope="col">RUANG</th> --}}
                                        <th class="text-center" scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="queueTableBody">
                                    @php
                                        $num = 1;
                                    @endphp
                                    @forelse ($queues as $queue)
                                        <tr>
                                            <td>{{ $num++ }}</td>
                                            <td id="tglKonsultasi">{{ $queue->tgl_konsultasi }}</td>
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
                                            <td id="sesi">{{ $sesi }}</td>
                                            <td id="namaTamu">{{ $queue->guests->nama_tamu }}</td>
                                            <td id="namKonsultan">{{ $queue->consultants->nama_konsultan }}</td>
                                            <td id="tipeKonsultasi">{{ $queue->tipe_konsultasi }}</td>
                                            {{-- <td id="topik">{{ $queue->topik }}</td> --}}
                                            {{-- <td id="ruang">{{ $queue->ruang }}</td> --}}
                                            {{-- <td>{{ $queue->anggota }}</td> --}}
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('admin-queue-del', $queue->id) }}" method="POST">
                                                    <a class="btn btn-sm" style="background-color: #1C1A30; color: #FDE4D0"
                                                        scope="col"
                                                        href="{{ route('admin-request-edit', $queue->id) }}">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm"
                                                        style="background-color: #1C1A30; color: #FDE4D0"
                                                        <?php if ($queue->tgl_konsultasi <= date('Y-m-d') ){ ?> disabled <?php } ?>>HAPUS</button>
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
                <div class="col-1">
                    <button class="btn btn-primary" id="openPopupBtn">Filter</button>
                </div>

                <div id="filterPopup" class="popup">
                    <div class="popup-content">
                        <button id="closePopupBtn" class="close-button" onclick="closePopup()"></button>
                        <div class="row">
                            <div class="col-12 head-form">
                                <h4>Filter</h4>
                            </div>
                            <hr>
                        </div>
                        <form id="filterForm" method="GET" action="{{ route('admin-request-filter') }}">
                            @csrf
                            <div class="container-fluid
                                form-group">
                                <div id="filterContainer">
                                    <div class="filter-row">
                                        <label class="form-label filter-margin" for="">Dimana:</label>
                                        <select class="select-filter filter-margin form-control"
                                            onchange="showAdditionalForm(this)" name="select_filter">
                                            <option value="">Pilih Opsi</option>
                                            <option value="tgl_konsultasi">Tanggal</option>
                                            <option value="consultants_nip">Konsultan</option>
                                        </select>
                                        <select class="select-operator filter-margin form-control" name="select_operator">
                                            <option value="=">Adalah</option>
                                            <option value="!=">Bukan</option>
                                        </select>
                                    </div>
                                </div>
                                <a href="#" id="addFilterBtn" onclick="addFilter()">+ Tambah Filter</a>
                            </div>
                            <button class="btn btn-success" type="button" onclick="sendFilterData()">Terapkan
                                Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JavaScript -->
    <script>
        document.getElementById("openPopupBtn").addEventListener("click", function() {
            document.getElementById("filterPopup").style.display = "block";
        });

        function closePopup() {
            document.getElementById("filterPopup").style.display = "none";
        }

        function addFilter() {
            var filterContainer = document.getElementById("filterContainer");
            var filterRow = document.createElement("div");
            filterRow.className = "filter-row";

            var select_logic = document.createElement("select");
            select_logic.className = "select-logic filter-margin form-control";
            select_logic.name = "select_logic";

            var and_operator = document.createElement("option");
            and_operator.value = "AND";
            and_operator.text = "Dan";
            select_logic.appendChild(and_operator);

            var or_operator = document.createElement("option");
            or_operator.value = "OR";
            or_operator.text = "Atau";
            select_logic.appendChild(or_operator);

            var select_filter = document.createElement("select");
            select_filter.className = "select-filter filter-margin form-control";
            select_filter.setAttribute("onchange", "showAdditionalForm(this)");
            select_filter.name = "select_filter";

            var option1 = document.createElement("option");
            option1.value = "";
            option1.text = "Pilih Opsi";
            select_filter.appendChild(option1);

            var option2 = document.createElement("option");
            option2.value = "tgl_konsultasi";
            option2.text = "Tanggal";
            select_filter.appendChild(option2);

            var option3 = document.createElement("option");
            option3.value = "consultants_nip";
            option3.text = "Konsultan";
            select_filter.appendChild(option3);

            var select_operator = document.createElement("select");
            select_operator.className = "select-operator filter-margin form-control";
            select_operator.name = "select_operator";

            var is_operator = document.createElement("option");
            is_operator.value = "=";
            is_operator.text = "Adalah";
            select_operator.appendChild(is_operator);

            var not_operator = document.createElement("option");
            not_operator.value = "!=";
            not_operator.text = "Bukan";
            select_operator.appendChild(not_operator);

            var removeBtn = document.createElement("a");
            removeBtn.setAttribute("href", "#");
            removeBtn.className = "remove-filter-btn";
            removeBtn.textContent = "Hapus";
            removeBtn.setAttribute("onclick", "removeFilter(this)");

            filterRow.appendChild(select_logic);
            filterRow.appendChild(select_filter);
            filterRow.appendChild(select_operator);
            // filterRow.appendChild(null_form);
            filterRow.appendChild(removeBtn);
            filterContainer.appendChild(filterRow);
        }

        function removeFilter(btn) {
            var filterRow = btn.parentNode;
            var filterContainer = filterRow.parentNode;
            filterContainer.removeChild(filterRow);
        }

        function showAdditionalForm(select_filter) {
            var selectedOption = select_filter.value;
            var parentRow = select_filter.parentNode;

            var additionalForm = parentRow.querySelector(".additional-form");
            var removeBtn = parentRow.querySelector(".remove-filter-btn");
            if (additionalForm) {
                parentRow.removeChild(additionalForm);
            }
            if (removeBtn) {
                parentRow.removeChild(removeBtn);
            }

            if (selectedOption === "tgl_konsultasi") {
                var fromDateInput = document.createElement("input");
                fromDateInput.type = "date";
                fromDateInput.className = "additional-form form-control form-margin";
                fromDateInput.name = "fromDate";

                var toDateInput = document.createElement("input");
                toDateInput.type = "date";
                toDateInput.className = "additional-form form-control form-margin";
                toDateInput.name = "toDate";

                var dateRangeContainer = document.createElement("div");
                dateRangeContainer.className = "additional-form date-range-container";
                dateRangeContainer.appendChild(fromDateInput);
                dateRangeContainer.appendChild(toDateInput);

                parentRow.appendChild(dateRangeContainer);
            } else if (selectedOption === "consultants_nip") {
                var consultantSelect = document.createElement("select");
                consultantSelect.className = "additional-form form-control form-margin";
                consultantSelect.name = "consultants_nip";

                var option1 = document.createElement("option");
                option1.value = "";
                option1.text = "Pilih Konsultan";
                consultantSelect.appendChild(option1);

                var option2 = document.createElement("option");
                option2.value = "1111111111";
                option2.text = "Pak Yudis";
                consultantSelect.appendChild(option2);

                var option3 = document.createElement("option");
                option3.value = "2222222222";
                option3.text = "Bu Ifa";
                consultantSelect.appendChild(option3);

                var option4 = document.createElement("option");
                option4.value = "123456789";
                option4.text = "Pak Harun";
                consultantSelect.appendChild(option4);

                parentRow.appendChild(consultantSelect);
            }

            var select_logic = parentRow.querySelector(".select-logic");
            if (select_logic) {
                var removeBtn = document.createElement("a");
                removeBtn.setAttribute("href", "#");
                removeBtn.className = "remove-filter-btn";
                removeBtn.textContent = "Hapus";
                removeBtn.setAttribute("onclick", "removeFilter(this)");
                parentRow.appendChild(removeBtn);
            } else {
                var removeBtn = document.createElement("a");
                removeBtn.setAttribute("href", "#");
                removeBtn.className = "remove-filter-btn";
                removeBtn.textContent = "Hapus";
                removeBtn.setAttribute("onclick", "removeFilter(this)");
                removeBtn.style.display = "none";
                parentRow.appendChild(removeBtn);
            }
        }

        function sendFilterData() {
            var filterForm = document.getElementById("filterForm");

            var filterRows = document.getElementsByClassName("filter-row");
            var filters = [];

            for (var i = 0; i < filterRows.length; i++) {
                var filterRow = filterRows[i];
                var selectLogic = filterRow.querySelector(".select-logic");
                var selectFilter = filterRow.querySelector(".select-filter");
                var selectOperator = filterRow.querySelector(".select-operator");
                var additionalForm = filterRow.querySelector(".additional-form");

                // var filter = {
                //     logic: selectLogic ? selectLogic.value : "",
                //     category: selectFilter.value,
                //     operator: selectOperator.value,
                //     additionalForm: additionalForm ? additionalForm.value : ""
                // };
                // var filter = {}

                if (selectFilter.value === "tgl_konsultasi") {
                    var fromDateInput = additionalForm.querySelector('input[name="fromDate"]');
                    var toDateInput = additionalForm.querySelector('input[name="toDate"]');

                    var filter = {
                        logic: selectLogic ? selectLogic.value : "",
                        category: selectFilter.value,
                        operator: selectOperator.value,
                        fromDate: fromDateInput.value,
                        toDate: toDateInput.value
                    };
                    // filter.additionalForm.fromDate = fromDateInput.value;
                    // filter.additionalForm.toDate = toDateInput.value;
                } else {
                    var filter = {
                        logic: selectLogic ? selectLogic.value : "",
                        category: selectFilter.value,
                        operator: selectOperator.value,
                        additionalForm: additionalForm ? additionalForm.value : ""
                    };
                }
                filters.push(filter);
            }

            var formData = new FormData();
            filters.forEach(function(filter, index) {
                if (filter.logic != null) {
                    formData.append("filters[" + index + "][logic]", filter.logic);
                }
                formData.append("filters[" + index + "][category]", filter.category);
                formData.append("filters[" + index + "][operator]", filter.operator);
                // if (filter.additionalForm !== "") {
                //     formData.append("filters[" + index + "][additionalForm]", filter.additionalForm);
                // }

                if (filter.additionalForm !== "") {
                    if (filter.category === "tgl_konsultasi") {
                        // formData.append("filters[" + index + "][additionalForm]", JSON.stringify(filter
                        //     .additionalForm));
                        formData.append("filters[" + index + "][fromDate]", filter.fromDate);
                        formData.append("filters[" + index + "][toDate]", filter.toDate);
                    } else if (filter.category !== "tgl_konsultasi") {
                        formData.append("filters[" + index + "][additionalForm]", filter.additionalForm);
                    }
                }
            });

            var request = new XMLHttpRequest();
            request.open("POST", filterForm.action, true);
            request
                .setRequestHeader("X-Requested-With", "XMLHttpRequest");
            request.setRequestHeader("X-CSRF-TOKEN", $(
                'input[name="_token"]').val());
            // Menangani respons dari server
            request.onload = function() {
                if (request.status == 200) {
                    // Respons berhasil, lakukan sesuatu jika diperlukan
                    console.log("Data berhasil terkirim ke server");
                } else {
                    // Respons gagal, lakukan penanganan galat jika diperlukan
                    console.error("Gagal mengirim data ke server");
                }
            };
            request.send(formData);

            request.onload = function() {
                if (request.status == 200) {
                    var response = JSON.parse(request.responseText);
                    if (response.hasOwnProperty('queues')) {
                        var queues = response.queues;
                        var tableBody = document.getElementById('queueTableBody');
                        if (tableBody) {
                            tableBody.innerHTML = ''; // Menghapus data sebelumnya dari tabel
                            queues.forEach(function(queue) {
                                var row = document.createElement('tr');

                                var numCell = document.createElement('td');
                                numCell.textContent = queue.num;
                                row.appendChild(numCell);

                                var tglKonsultasiCell = document.createElement('td');
                                tglKonsultasiCell.textContent = queue.tgl_konsultasi;
                                row.appendChild(tglKonsultasiCell);

                                var sesiCell = document.createElement('td');
                                sesiCell.textContent = queue.sesi;
                                row.appendChild(sesiCell);

                                var namaTamuCell = document.createElement('td');
                                namaTamuCell.textContent = queue.nama_tamu;
                                row.appendChild(namaTamuCell);

                                var namaKonsultanCell = document.createElement('td');
                                namaKonsultanCell.textContent = queue.nama_konsultan;
                                row.appendChild(namaKonsultanCell);

                                var tipeKonsultasiCell = document.createElement('td');
                                tipeKonsultasiCell.textContent = queue.tipe_konsultasi;
                                row.appendChild(tipeKonsultasiCell);

                                // var topikCell = document.createElement('td');
                                // topikCell.textContent = queue.topik;
                                // row.appendChild(topikCell);

                                // var ruangCell = document.createElement('td');
                                // ruangCell.textContent = queue.ruang;
                                // row.appendChild(ruangCell);

                                var actionCell = document.createElement('td');

                                var editLink = document.createElement('a');
                                editLink.className = 'btn btn-sm';
                                editLink.style.backgroundColor = '#1C1A30';
                                editLink.style.color = '#FDE4D0';
                                editLink.href = '{{ route('admin-request-edit', ':id') }}'.replace(':id',
                                    queue.id);
                                editLink.textContent = 'EDIT';

                                var deleteForm = document.createElement('form');
                                deleteForm.onsubmit = function() {
                                    return confirm('Apakah Anda Yakin ?');
                                };
                                deleteForm.action = '{{ route('admin-queue-del', ':id') }}'.replace(':id',
                                    queue.id);
                                deleteForm.method = 'POST';

                                var deleteButton = document.createElement('button');
                                deleteButton.type = 'submit';
                                deleteButton.className = 'btn btn-sm';
                                deleteButton.style.backgroundColor = '#1C1A30';
                                deleteButton.style.color = '#FDE4D0';
                                deleteButton.textContent = 'HAPUS';
                                if ('{{ ':tgl_konsultasi' }}'.replace(':tgl_konsultasi', queue
                                        .tgl_konsultasi) <= '{{ date('Y-m-d') }}') {
                                    deleteButton.disabled = true;
                                }

                                deleteForm.appendChild(deleteButton);
                                actionCell.appendChild(editLink);
                                actionCell.appendChild(deleteForm);

                                row.appendChild(actionCell);

                                tableBody.appendChild(row);
                            });
                        }

                        console.log("Data berhasil diperbarui");
                    }
                } else {
                    console.error("Gagal mengirim data ke server");
                }
            };

        }
    </script>
@endsection
