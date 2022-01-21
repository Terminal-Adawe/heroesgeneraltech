<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('location')->after('role')->nullable();
            $table->string('contact_number')->after('location')->nullable();
            $table->string('address')->after('location')->nullable();
            $table->date('dob')->after('location')->nullable();
            $table->string('position')->after('address')->nullable();
            $table->text('about')->after('location')->nullable();
            $table->string('country')->after('contact_number')->nullable();
            $table->string('city')->after('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_tables', function (Blueprint $table) {
            //
        });
    }
}
