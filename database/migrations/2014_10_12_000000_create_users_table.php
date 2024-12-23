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
            $table->string('name',50);
            $table->string('email',50)->unique();
            $table->string('mobile',20)->nullable();
            $table->string('password',255);
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('otp',6)->nullable();
            $table->string('avatar',50)->nullable();
            $table->decimal('balance',10,2)->default(0); // added balance column
            $table->ipAddress('ipaddress');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
