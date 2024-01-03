@extends('layouts.app')

@section('title', 'Data Customer')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Customer</h6>
    </div>
    <div class="card-body">
			@if (auth()->user()->level == 'Admin')
      <a href="{{ route('customer.tambah') }}" class="btn btn-primary mb-3">Tambah</a>
			@endif
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Nomor Telepon</th>
              <th>Email</th>
							@if (auth()->user()->level == 'Admin')
              <th>Aksi</th>
							@endif
            </tr>
          </thead>
          <tbody>
            @php($no =1)
            @foreach ($data as $row)
              <tr>
                <th>{{ $no++ }}</th>
                <td>{{ $row->nama_customer }}</td>
                <td>{{ $row->alamat_customer }}</td>
                <td>{{ $row->no_telp}}</td>
                <td>{{ $row->email_customer}}</td>
								@if (auth()->user()->level == 'Admin')
                <td>
                  <a href="{{ route('customer.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                  <a href="{{ route('customer.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                </td>
								@endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
