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
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
		Schema::table('users', function(Blueprint $table) {
			$table->smallInteger('isadmin')->after('password');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->smallInteger('issuperadmin')->after('isadmin');
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
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('isadmin');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('issuperadmin');
		});
    }
}
