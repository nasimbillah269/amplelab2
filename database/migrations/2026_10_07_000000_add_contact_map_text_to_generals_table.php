<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->string('contact_map_title', 150)->nullable();
            $table->text('contact_map_text')->nullable();
        });
    }

    public function down()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->dropColumn(['contact_map_title', 'contact_map_text']);
        });
    }
};
