<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
           
            $table->integer('package')->default(0);
            $table->string('field')->nullable();
            $table->string('type')->nullable();
            $table->integer('batch')->nullable();
            $table->string('location')->nullable();
            $table->string('branch')->nullable();
            $table->string('ways');
            $table->timestamps();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preferences');
    }
}
