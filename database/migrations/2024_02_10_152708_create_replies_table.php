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
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('contact_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); //for contact just from quick contact email
            $table->string('c_email')->nullable();  //for contact just from quick contact email
            $table->integer('user_id')->nullable();
            $table->text('message')->nullable();
            $table->text('reply_date')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
