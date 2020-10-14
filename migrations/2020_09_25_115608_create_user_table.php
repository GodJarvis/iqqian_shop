<?php

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable(false)->comment('名称');
            $table->string('avatar', 300)->nullable()->comment('头像');
            $table->string('mobile', 11)->nullable(false)->unique()->comment('手机号');
            $table->char('password', 32)->nullable(false)->comment('密码');
            $table->string('motto', 300)->nullable()->charset('utf8mb4')->comment('座右铭');
            $table->string('last_ip', 15)->nullable()->comment('登录ip');
            $table->integer('created_at', false)->comment('创建时间');
            $table->integer('updated_at', false)->comment('更新时间');

            $table->index(['mobile', 'password'], 'mobile_password');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
}
