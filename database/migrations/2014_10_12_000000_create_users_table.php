<?php

use App\Models\Job;
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
            $table->string('name')->comment('Имя');
            $table->string('phone')->nullable()->comment('Телефон');
            $table->string('email')->unique()->comment('E-mail');
            $table->foreignId('job_id')->nullable()->comment('Должность')->constrained();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('Пароль');
            $table->rememberToken();
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
