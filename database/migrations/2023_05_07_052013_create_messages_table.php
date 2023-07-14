<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('replyer_id');
            $table->tinyInteger('usertype');//who is the replyer a student , tpr or admin
            $table->bigInteger('chat_id');
            $table->string('message');
            $table->string('status'); //0 unseen 1 seen 
          //  $table->string('forwarded');//if 0 show to tpr only tpr if 1 show to admin and tpr
          
          //  $table->foreign('chat_id')->references('id')->on('chats');
           // $table->foreign('job_id')->references('job_id')->on('jobs');
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
        Schema::dropIfExists('messages');
    }
}
