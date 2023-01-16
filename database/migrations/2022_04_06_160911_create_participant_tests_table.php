<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_tests', function (Blueprint $table) {
            $table->id();
            // participant_id
            $table->foreignId('participant_id')->constrained()->onDelete('cascade');
            // test_id
            $table->foreignId('test_id')->constrained()->onDelete('cascade');
            // start_at
            $table->timestamp('start_at')->nullable();
            // is_completed
            $table->boolean('is_completed')->default(false);
            // is_verified
            $table->boolean('is_verified')->default(false);
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
        Schema::dropIfExists('participant_tests');
    }
}
