<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id');
            $table->timestamp('revision_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('summary');
            $table->text('old');
            $table->text('new');

            // Foreign Key Constraint
            $table->foreign('record_id')->references('id')->on('job_drafts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisions');
    }
};
