<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recent_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->date('tanggal');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('judul',200);
            $table->string('slug',255);
            $table->longText('deskripsi');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recent_blogs');
    }
}
