<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the existing foreign key (referencing admins)
            $table->dropForeign(['admin_id']);

            // Add the correct foreign key (referencing shops)
            $table->foreign('admin_id')
                ->references('id')
                ->on('shops')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Rollback: drop foreign key referencing shops
            $table->dropForeign(['admin_id']);

            // Optionally, restore the old foreign key (not required if you're correcting)
            // $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }
};