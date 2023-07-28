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
        Schema::create('nhapxuat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tenHang');
            $table->string('tenCongTy');
            $table->integer('soXe');
            $table->string('tenNV');
            $table->integer('NET');
            $table->integer('soLuong');
            $table->integer('trongLuong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('nhapxuat');
    }
};
