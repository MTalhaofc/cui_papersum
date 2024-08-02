<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastPaperImagesTable extends Migration
{
    public function up()
    {
        Schema::create('past_paper_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('past_paper_id');
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('past_paper_id')->references('id')->on('past_papers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('past_paper_images');
    }
}
