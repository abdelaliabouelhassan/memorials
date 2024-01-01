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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('qrcode_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->string('fullname')->nullable();
            $table->string('residence')->nullable();
            $table->string('religious')->nullable();
            $table->date('birthday')->nullable();
            $table->date('death')->nullable();
            $table->string('profession')->nullable();
            $table->longText('miscellaneous')->nullable();
            $table->longText('description')->nullable();
            $table->string('password')->nullable();
            $table->boolean('private')->default(false)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
