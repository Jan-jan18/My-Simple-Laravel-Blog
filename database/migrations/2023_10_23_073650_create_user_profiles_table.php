<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('user_profiles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('display_name')->nullable();
        $table->string('profile_picture')->nullable();
        $table->text('bio')->nullable();
        $table->string('website')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
