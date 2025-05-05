<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('image')->nullable();
            $table->string('deskripsi')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
        });

        // Tabel tag
        Schema::create('tag', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        // Tabel publikasi
        Schema::create('publikasi', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->longText('content')->nullable();
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('cascade');
            $table->boolean('publish')->default(false);
            $table->boolean('highlight')->default(false);
            $table->year('tahun');
            $table->timestamps();
        });

        // Tabel artikel
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('nama')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('publish')->default(false);
            $table->boolean('highlight')->default(false);
            $table->timestamps();
        });

        // Tabel agenda
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('sudah_lewat')->default(false);
            $table->date('tanggal');
            $table->timestamps();
        });

        // Tabel kerjasama
        Schema::create('kerjasama', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('nama')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('publish')->default(false);
            $table->timestamps();
        });

        // Tabel pivot artikel_tag
        Schema::create('artikel_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artikel_id')->constrained('artikel')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tag')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel pivot publikasi_tag
        Schema::create('publikasi_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publikasi_id')->constrained('publikasi')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tag')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publikasi_tag');
        Schema::dropIfExists('artikel_tag');
        Schema::dropIfExists('kerjasama');
        Schema::dropIfExists('agenda');
        Schema::dropIfExists('artikel');
        Schema::dropIfExists('publikasi');
        Schema::dropIfExists('tag');
        Schema::dropIfExists('dosen');
    }
};
