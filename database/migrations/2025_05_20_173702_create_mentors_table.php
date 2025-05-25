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
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
<<<<<<< HEAD
            $table->string('surname');
=======
            $table->string('image');
>>>>>>> 5a633610c41e3078f1ca7f781879e231f8a860bd
            $table->string('login')->unique();
            $table->string('password');
            $table->foreignId('admin_id')->constrained()->cascadeOnDelete();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
