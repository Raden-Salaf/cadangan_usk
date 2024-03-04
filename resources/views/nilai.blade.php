@extends('master')
@section('konten')
    <!DOCTYPE html>
    <html>

    <head>
        <title>Nilai</title>
        <style>
            /* CSS untuk mempercantik tampilan tabel */
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }

            h2 {
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                background-color: #dc3545;
                /* Warna latar merah */
                color: rgb(24, 19, 19);
                /* Warna teks putih */
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #dc3545;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .btn {
                padding: 8px 12px;
                border-radius: 4px;
                cursor: pointer;
                border: none;
                color: white;
            }

            .btn-danger {
                background-color: #dc3545;
            }

            .btn-success {
                background-color: #28a745;
            }

            .btn-primary {
                background-color: #007bff;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            .modal-header h1 {
                margin: 0;
            }

            .modal-body {
                padding: 10px 0;
            }

            .form-control {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .modal-footer {
                padding: 10px 0;
            }
        </style>
    </head>

    <body>
        <b>
            <h2 class="text-primary">Data Nilai</h2>
        </b>
        <br />
        <table class="table table-dark table-hover m-lg-2">
            <tr>
                <th>ID Soal</th>
                <th>ID User</th>
                <th>Jawaban Tugas</th>
                <th>Nilai</th>
                <th>Status</th>
            </tr>
            @foreach ($nilai as $n)
                <tr>
                    <td>{{ $n->idsoal }}</td>
                    <td>{{ $n->name }}</td>
                    <td>{{ $n->jawabansoal }}</td>
                    <td>{{ $n->nilai }}</td>
                    <td>
                        @if (Auth::user()->role == 'admin')
                            @if ($n->status != 'selesai')
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#UpdateStatus{{ $n->idnilai }}">
                                    {{ $n->status }}
                                </button>
                            @elseif($n->status == 'selesai')
                                <button class="btn btn-success">
                                    {{ $n->status }}
                                </button>
                            @endif
                        @else
                            <button class="btn btn-primary">{{ $n->status }}</button>
                        @endif
                    </td>
                </tr>
                <!-- Ini tampil form update Status -->
                <div class="modal fade" id="UpdateStatus{{ $n->idnilai }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Status</h1>
                            </div>
                            <div class="modal-body">
                                <form action="/nilai/storeupdate" method="post" class="form-floating">
                                    @csrf
                                    <input type="hidden" name="idnilai" id="idnilai" readonly class="form-control"
                                        value="{{ $n->idnilai }}">
                                    <div class="form-floating">
                                        <label for="floatingInputValue">Nilai Tugas</label>
                                        <input type="text" name="nilai" required="required" class="form-control"
                                            value="{{ $n->nilai }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Updates</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </table>
    </body>

    </html>
@endsection
