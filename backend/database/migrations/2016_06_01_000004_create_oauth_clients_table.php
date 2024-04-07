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
        Schema::create('oauth_clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('secret', 100)->nullable();
            $table->string('provider')->nullable();
            $table->text('redirect');
            $table->boolean('personal_access_client');
            $table->boolean('password_client');
            $table->boolean('revoked');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('public.users')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oauth_clients');
    }
};
