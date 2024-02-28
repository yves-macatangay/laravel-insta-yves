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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->longText('avatar')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('introduction', 100)->nullable();
            $table->integer('role_id')->default(2)->comment('admin:1 user:2');
            //default(n) - n is default value of the column
            //comment - a note; no effect on data
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
