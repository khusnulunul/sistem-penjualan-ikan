<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	use HasFactory;

	protected $table = 'customer';

	protected $fillable = ['nama_customer', 'alamat_customer', 'no_telp', 'email_customer'];

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'id_customer');
	}

}
