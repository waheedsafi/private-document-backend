<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_destinations', function (Blueprint $table) {
            $table->id();
            $table->integer('step');
            $table->string('deadline')->nullable();
            $table->string('feedback_date')->nullable();
            $table->timestamp('send_date')->useCurrent();
            $table->text('feedback')->nullable();
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->unsignedBigInteger('destination_id');
            $table->index(['document_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_destinations');
    }
};
