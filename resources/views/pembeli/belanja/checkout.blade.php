@extends('layout.pembeli')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-2">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('pembeli') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('belanja') }}">Belanja</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            @if (empty($pesanan))
                <div class="container text-right">
                    <p>Tanggal Pesanan: -</p>
                </div>
                <table class="table table-bordered">
                    <thread>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thread>
                    <tbody>
                        <tr>
                            <td colspan="6"><strong>Belum Tersedia</strong></td>
                        </tr>
                        <tr>
                            <td colspan="6"><strong>Silahkan pesan produk yang kamu suka</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                            <td><strong>Rp. 0</strong></td>
                            <td>
                                <a href="{{ route('belanja') }}" class="btn btn-succes"><i class="fa fa-shopping-cart"></i>
                                    Bayar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
            @if (!empty($pesanan))
                <div class="container text-right">
                    <p>Tanggal Pesanan: {{ $pesanan->tanggal }}</p>
                </div>
                <table class="table table-bordered">
                    <thread>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thread>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pesanan_details as $pesanan_detail)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('gambar/produk/' . $pesanan_detail->produk->gambar) }}"
                                        alt="" style="width:50px">
                                </td>
                                <td>{{ $pesanan_detail->produk->nama_barang }}</td>
                                <td class="text-center">{{ $pesanan_detail->jumlah }}</td>
                                <td class="text-center" align="left">Rp.
                                    {{ number_format($pesanan_detail->produk->harga) }}</td>
                                <td class="text-center">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
                                <td class="text-center">
                                    <a href="{{ url('pembeli/deleteco', $pesanan_detail->id) }}"
                                        type="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                            <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                            {{-- <td class="text-center">
                                <a href="{{ url('pembeli/konfirmasico') }}" class="btn btn-succes"
                                    onclick="return confirm('Anda yakin akan melakukan pembayaran ?');"><i
                                        class="fa fa-shopping-cart"></i> Bayar</a>
                            </td> --}}
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-shopping-cart"></i> Bayar
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('pembeli/transfer') }}">Transfer</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
