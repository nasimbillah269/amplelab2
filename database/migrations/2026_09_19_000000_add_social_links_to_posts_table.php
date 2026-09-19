<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('youtube_link', 255)->nullable()->after('bar_code');
            $table->string('facebook_video_link', 255)->nullable()->after('youtube_link');
            $table->string('whatsapp_number', 50)->nullable()->after('facebook_video_link');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['youtube_link', 'facebook_video_link', 'whatsapp_number']);
        });
    }
};
