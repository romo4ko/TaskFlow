<?php

use App\Models\User;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Название');
            $table->string('description')->nullable()->comment('Описание');
            $table->string('extended')->nullable()->comment('Дополнительно');
            $table->integer('status')->default(0)->comment('Статус');
            $table->foreignId('pm_id')->comment('Руководитель')->constrained(table: 'users');
            $table->date('date_start')->default(\Carbon\Carbon::now())->comment('Дата начала');
            $table->date('date_end')->nullable()->comment('Дата окончания');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
