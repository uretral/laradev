<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_samples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->nullable();
            $table->string('name')->nullable();
            $table->string('intro_img')->nullable();
            $table->text('intro')->nullable();
            $table->string('detail_img')->nullable();
            $table->text('detail')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_desc')->nullable();
            $table->text('seo_key')->nullable();
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
        Schema::dropIfExists('block_samples');
    }
}
