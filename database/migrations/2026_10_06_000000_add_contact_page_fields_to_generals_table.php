<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->text('contact_address')->nullable();
            $table->text('contact_phones')->nullable();
            $table->text('contact_emails')->nullable();
            $table->text('contact_hours')->nullable();
            $table->text('contact_map_embed_url')->nullable();
            $table->string('contact_directions_url', 500)->nullable();
        });
    }

    public function down()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->dropColumn([
                'contact_address',
                'contact_phones',
                'contact_emails',
                'contact_hours',
                'contact_map_embed_url',
                'contact_directions_url',
            ]);
        });
    }
};
