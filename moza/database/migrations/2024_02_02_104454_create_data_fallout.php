<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fallout', function (Blueprint $table) {
            $table->integer('order_id')->primary;
            $table->string('status_message');
            $table->string('sto');
            $table->date('tanggal_fallout');
            $table->string('pic');
            $table->string('status');
            $table->integer('ket');
        });
    }

    /**
     * Reverse the migrations.
     */
};
