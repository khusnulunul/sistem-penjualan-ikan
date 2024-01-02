@extends('layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Transaksi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md">
                                    <a href="{{ route('exportpdf') }}" class="btn btn-outline-success">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                </div>
                                <div class="col-md"></div>
                            </div>
                            <table class="table table-bordered table-hover" id="data">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Pemesan</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Pembayaran</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Jumlah Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nom = 1;
                                    @endphp
                                    @foreach ($data as $row)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $nom++ }}</th>
                                            <td class="text-center">{{ Str::limit($row->user->name, 20) }}</td>
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
                                                    <a href="{{ route('cekbuktitf', $row->id) }}" class="btn btn-primary"><i
                                                            class="fa fa-info-circle"></i></a>
                                                @elseif ($row->status == 2)
                                                    <a href="{{ route('selesai', $row->id) }}" class="btn btn-info"><i
                                                            class="fa fa-check-circle"></i></a>
                                                @elseif ($row->status == 3)
                                                    <a href="{{ route('invoiceadmin', $row->id) }}" class="btn btn-dark"><i
                                                            class="fa fa-download"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row mt-3 text-right">
                                {{ $data->links() }}
                            </div>
                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!--/. container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
