<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->integer('designation_id');
            $table->string('mobile');
            $table->string('gender')->nullable();
            $table->string('profile_image');
            $table->integer('hr_approve')->default(1);
            $table->string('status');
            $table->integer('lateness')->default(0);
            $table->timestamp('member_since')->nullable();
            $table->timestamp('sign_in_threshold')->nullable();
            $table->timestamp('ban_time')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
