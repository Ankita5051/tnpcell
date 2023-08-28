<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->nullable();
            $table->integer('sender_id');
            $table->string('subject',1000);
            $table->text('query');
            $table->tinyInteger('usertype');//who is the replyer a student , tpr or admin
            // $table->foreign('sender_id')->references('id')->on('students');
            $table->tinyInteger('status'); //0 not answered 1 answered 
            $table->tinyInteger('forwarded'); //if 0 show to tprs only if 1 show to admin
            $table->tinyInteger('is_expired'); // if job expires don't show questions to students if date of job extended show it to student and make it 0
        
            $table->foreign('job_id')->references('job_id')->on('jobs');
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
        Schema::dropIfExists('chats');
    }
}
