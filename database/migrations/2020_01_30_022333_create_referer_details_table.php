<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefererDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('referers_id');
            $table->bigInteger('short_urls_id');
            $table->bigInteger('user_id')->nullable()->default(0);
            $table->string('refer_name')->nullable();
            $table->string('remote_addr')->nullable();
            $table->integer('request_at')->unsigned()->nullable()->default(0);
            $table->integer('counter')->unsigned()->nullable()->default(0);
        
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
        Schema::dropIfExists('referer_details');
    }
}
