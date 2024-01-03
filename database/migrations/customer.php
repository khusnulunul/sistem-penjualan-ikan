<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer', function (Blueprint $table) {
			$table->id();
			$table->string('id_customer')->nullable();
			$table->string('nama_customer')->nullable();
			$table->string('alamat_customer')->nullable();
			$table->string('no_telp')->nullable();
			$table->integer('email_customer')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('customer');
	}
};
