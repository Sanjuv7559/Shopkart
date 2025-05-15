<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add the admin_id column
            $table->unsignedBigInteger('admin_id')->after('id');

            // Reference the shops table instead of admins
            $table->foreign('admin_id')
                ->references('id')
                ->on('shops')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the foreign key and column on rollback
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};
