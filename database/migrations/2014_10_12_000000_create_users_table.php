<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $sql = 'INSERT INTO paperWall.users (name,email,password,remember_token,created_at,updated_at) VALUES 
("Rich","rich.gwilliam@gmail.com","$2y$10$Oe.rk6TKB2WiuoC.6Xp9fOeixd0znxNS0jyhn/s8JIuJ7nB1bgfF6",NULL,NULL,NULL)
;';
        DB::connection()->getPdo()->exec( $sql ); 
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
