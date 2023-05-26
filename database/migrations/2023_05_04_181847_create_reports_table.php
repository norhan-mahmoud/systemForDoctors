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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('mrn');
            $table->foreignId('department_id')->constrained();
            $table->string('mrp');
            $table->string('note')->nullable();
            $table->integer('age');
            $table->foreignId('type')->constrained();
            $table->boolean('blood');
            $table->string('stage');
            $table->string('status')->default('not completed'); 
            $table->bigInteger('user_created_id');   
            $table->foreign('user_created_id')->references('id')->on('users');
            $table->bigInteger('user_updated_id')->nullable(); 
            $table->foreign('user_updated_id')->references('id')->on('users');
            $table->tinyText('sex');
            $table->string('SurgicalProcedure')->nullable();
            $table->string('diagnosis')->nullable();
            $table->timestamp('dateofadmission');
            $table->timestamp('dateofdischarge');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
