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
        Schema::create('job_drafts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_order_id');
            $table->enum('type', ['content_writer', 'graphic_designer']);
            $table->timestamp('date_started')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('date_target');
            $table->longText('signature_admin')->nullable();
            $table->longText('signature_top_manager')->nullable();
            $table->string('status');

            // Foreign Key Constraint
            $table->foreign('job_order_id')->references('id')->on('job_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_drafts');
    }
};
