<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
	public function index()
	{
		$customer = Customer::get();

		return view('customer.index', ['data' => $customer]);
	}

	public function tambah()
	{
		$customer = Customer::get();

		return view('customer.form', ['customer' => $customer]);
	}

	public function simpan(Request $request)
	{
		$data = [
            'id_customer' => $request->id_customer,
			'nama_customer' => $request->nama_customer,
			'alamat_customer' => $request->alamat_customer,
			'no_telp' => $request->no_telp,
			'email_customer' => $request->email_customer,
		];

		Customer::create($data);

		return redirect()->route('customer');
	}

	public function edit($id)
	{
		$customer = Customer::find($id)->first();

		return view('customer.form', ['customer' => $customer]);
	}

	public function update($id, Request $request)
	{
		$data = [
			'id_customer' => $request->id_customer,
			'nama_customer' => $request->nama_customer,
			'alamat_customer' => $request->alamat_customer,
			'no_telp' => $request->no_telp,
			'email_customer' => $request->email_customer,
		];

		Customer::find($id)->update($data);

		return redirect()->route('Customer');
	}

	public function hapus($id)
	{
		Customer::find($id)->delete();

		return redirect()->route('customer');
	}
}
