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
        Schema::create('lich_su_nhap_khos', function (Blueprint $table) {
            $table->id();
            $table->string('id_sp');
            $table->string('tensanpham');
            $table->string('soluongkho');
            $table->string('soluongnhap');
            $table->string('soluongkhinhap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_nhap_khos');
    }
};
