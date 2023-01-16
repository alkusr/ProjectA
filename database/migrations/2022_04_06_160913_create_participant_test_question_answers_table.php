<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantTestQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_test_question_answers', function (Blueprint $table) {
            $table->id();
            // participant_test_id
            $table->foreignId('participant_test_id')->constrained()->onDelete('cascade');
            // test_question_id
            $table->foreignId('test_question_id')->constrained()->onDelete('cascade');
            // choice A, B, C, D, E
            $table->enum('answer', ['A', 'B', 'C', 'D', 'E'])->nullable();
            // boolean (true/false) sure_answer
            $table->boolean('confidence_answer')->nullable();
            $table->enum('answer_reason', ['A', 'B', 'C', 'D', 'E'])->nullable();
            // boolean sure_answer_reason
            $table->boolean('confidence_answer_reason')->nullable();
            // test_result_category_id
            // unsigned bigint
            $table->unsignedBigInteger('test_result_category_id')->nullable();

            $table->foreign('test_result_category_id', 'tr_category')->references('id')->on('test_result_categories')->onDelete('cascade');
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
        Schema::dropIfExists('participant_test_question_answers');
    }
}
