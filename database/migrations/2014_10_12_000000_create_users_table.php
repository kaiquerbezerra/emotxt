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

            $table->foreignId('responsible_id')->nullable()->constrained('users');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf', 14)->nullable()->unique();    
            
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['Not Informed', 'Male', 'Female', 'Other'])->nullable()->default('Not Informed');
            $table->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed', 'Stable Union', 'Other'])->nullable();
            $table->string('occupation', 45)->nullable();
        
            $table->string('cep', 10)->nullable();
            $table->string('address', 60)->nullable();
            $table->string('number', 10)->nullable();
            $table->string('district', 45)->nullable();
            $table->string('complement', 60)->nullable();
            $table->string('reference', 100)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('state', 2)->nullable();


            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
