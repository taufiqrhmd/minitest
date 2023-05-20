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
        Schema::create('tb_penulis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50);
            $table->string('password', 256);
            $table->boolean('status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('tb_artikel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul_artikel', 50);
            $table->text('isi_artikel');
            $table->integer('id_penulis')->unsigned();
            $table->date('tanggal');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('id_penulis')->references('id')->on('tb_penulis')->onDelete('CASCADE');
        });

        Schema::create('tb_komentar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
            $table->text('isi_komentar');
            $table->string('email', 30);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('tb_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_artikel')->unsigned();
            $table->integer('id_komentar')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('id_artikel')->references('id')->on('tb_artikel')->onDelete('CASCADE');
            $table->foreign('id_komentar')->references('id')->on('tb_komentar')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail');
        Schema::dropIfExists('tb_komentar');
        Schema::dropIfExists('tb_artikel');
        Schema::dropIfExists('tb_penulis');
    }
};
