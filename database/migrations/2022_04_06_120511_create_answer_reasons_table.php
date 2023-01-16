<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_reasons', function (Blueprint $table) {
            $table->id();
            // question_id
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            // text
            $table->longText('reason');
            // key (A, B, C, D, E)
            $table->enum('key', ['A', 'B', 'C', 'D', 'E']);
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
        Schema::dropIfExists('answer_reasons');
    }
}
