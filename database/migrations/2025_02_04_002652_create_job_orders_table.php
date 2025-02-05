<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('content_writer_id');
            $table->unsignedBigInteger('graphic_designer_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('issued_by');
            $table->boolean('renewable')->default(false);

            // Foreign Key Constraints
            $table->foreign('content_writer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('graphic_designer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_orders');
    }
};
