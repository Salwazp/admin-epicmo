<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('media_youtube', function (Blueprint $table) {
            $table->id();
            $table->string('image', 255)->nullable();
            $table->text('link_youtube')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('media_youtube');
    }
};
