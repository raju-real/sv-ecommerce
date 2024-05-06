<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('email',30)->unique();
            $table->string('mobile',11)->unique()->nullable();
            $table->string('password_plain',10);
            $table->string('password',255);
            $table->rememberToken();
            $table->string('image',255)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>Active,2=>In active');
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('last_logout_at')->nullable();
            $table->timestamps();
            $table->integer('created_by');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
