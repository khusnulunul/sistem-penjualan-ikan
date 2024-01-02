@extends('layout.pembeli')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-2">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Riwayat</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('pembeli') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('belanja') }}">Belanja</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Riwayat</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Pembayaran</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Jumlah Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thread>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pesanan as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $row->tanggal }}</td>
                            <td class="text-center">
                                @if ($row->pembayaran == 0)
                                    Transfer Bank
                                @elseif ($row->pembayaran == 1)
                                    Bayar Langsung
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($row->status == 1)
                                    Belum Bayar
                                @elseif($row->status == 2)
                                    Sudah Dibayar
                                @elseif($row->status == 3)
                                    Selesai
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($row->pembayaran == 0)
                                    Rp. {{ number_format($row->jumlah_harga + $row->kode) }}
                                @elseif ($row->pembayaran == 1)
                                    Rp. {{ number_format($row->jumlah_harga) }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($row->status == 1)
                                    <a href="{{ url('pembeli/riwayatdetail', $row->id) }}"
                                        class="btn btn-outline-primary"><i class="fa fa-info-circle"></i></a>
                                @elseif ($row->status == 2)
                                    <a href="{{ route('invoice', $row->id) }}" class="btn btn-outline-info"><i class="fa fa-download"></i></a>
                                @elseif ($row->status == 3)
                                    <a href="{{ route('invoice', $row->id) }}" class="btn btn-outline-success"><i class="fa fa-download"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
