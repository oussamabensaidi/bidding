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
            $table->string('name'); // Name of the user
            $table->string('email')->unique(); // Unique email
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('password'); // User password
            $table->string('role')->default('client'); // Role (client or admin)
            $table->string('profile_picture')->nullable(); // Profile picture
            $table->decimal('ourtaxes', 8, 2)->nullable()->default(0); // Taxes 1% on both admin and cllient on each operation
            $table->decimal('balance', 10, 2)->nullable()->default(0); // User's balance 
            $table->decimal('maximumbid', 10, 2)->nullable(); // Maximum bid Client can place
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created_at and updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
