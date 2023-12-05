@extends('layouts.app')

@section('title', 'Form Customer')

@section('contents')
  <form action="{{ isset($customer) ? route('customer.tambah.update', $customer->id) : route('customer.tambah.simpan') }}" method="post">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($customer) ? 'Form Edit customer' : 'Form Tambah customer' }}</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="nama_customer">Nama</label>
              <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{ isset($customer) ? $customer->nama_customer : '' }}">
            </div>
            <div class="form-group">
              <label for="alamat_customer">Alamat</label>
              <input type="text" class="form-control" id="alamat_customer" name="alamat_customer" value="{{ isset($customer) ? $customer->alamat_customer : '' }}">
            </div>
            <div class="form-group">
                <label for="no_telp">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ isset($customer) ? $customer->no_telp : '' }}">
              </div>
              <div class="form-group">
                <label for="email_customer">Email</label>
                <input type="text" class="form-control" id="email_customer" name="email_customer" value="{{ isset($customer) ? $customer->email_customer : '' }}">
              </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
