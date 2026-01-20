<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('document_storages', function (Blueprint $table) {
            // drop existing foreign key
            $table->dropForeign(['uploaded_by']);

            // make column nullable
            $table->unsignedBigInteger('uploaded_by')->nullable()->change();

            // add new foreign key with SET NULL
            $table->foreign('uploaded_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('document_storages', function (Blueprint $table) {
            $table->dropForeign(['uploaded_by']);

            // revert column
            $table->unsignedBigInteger('uploaded_by')->nullable(false)->change();

            // restore CASCADE
            $table->foreign('uploaded_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }
};
