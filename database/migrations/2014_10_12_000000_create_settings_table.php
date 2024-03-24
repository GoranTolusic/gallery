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
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label')->unique();
            $table->string('title');
            $table->enum('style', ['dark_mode', 'normal'])->default('normal');
            $table->enum('font', ['arial', 'verdana', 'times_new_roman', 'open_sans'])->default('arial');
            $table->text('about')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('quote')->nullable();
            $table->string('home_banner_picture')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_facebook')->nullable();
            $table->string('contact_instagram')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
