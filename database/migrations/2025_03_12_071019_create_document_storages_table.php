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
        Schema::create('document_storages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('filename');
            $table->unsignedBigInteger('uploaded_by');
            $table->string('download_link');
            $table->timestamps();
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_storages');
    }
};
