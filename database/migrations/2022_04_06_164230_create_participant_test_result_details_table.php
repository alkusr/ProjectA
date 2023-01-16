<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantTestResultDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_test_result_details', function (Blueprint $table) {
            $table->id();
            // participant_test_result_id
            $table->unsignedBigInteger('participant_test_result_id');
            $table->foreign('participant_test_result_id', "pt_result_id")->references('id')->on('participant_test_results')->onDelete('cascade');
            $table->foreignId('test_result_category_id')->constrained()->onDelete('cascade');
            $table->float('percent')->default(0);
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
        Schema::dropIfExists('participant_test_result_details');
    }
}
