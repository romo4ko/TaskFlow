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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->comment('Проект')->constrained();
            $table->string('name')->comment('Название');
            $table->string('description')->nullable()->comment('Описание');
            $table->foreignId('parent_id')->nullable()->comment('Родительская задача')->constrained(table: 'tasks');
            $table->integer('status')->default(0)->comment('Статус');
            $table->integer('done')->default(0)->comment('Выполнена %');
            $table->integer('type')->nullable()->comment('Тип');
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
        Schema::dropIfExists('tasks');
    }
};
