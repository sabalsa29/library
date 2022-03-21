<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users','tipo')){
            Schema::table('users', function(Blueprint $table) {
                $table->integer('tipo')->default(2)->after('id');
            });
        }
        if (!Schema::hasColumn('users','estatus')){
            Schema::table('users', function(Blueprint $table) {
                $table->integer('estatus')->default(1)->after('remember_token');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if( Schema::hasColumn('users','tipo')){
            Schema::table('users', function(Blueprint $table) {
                $table->dropcolumn('tipo');
            });
        }
        if( Schema::hasColumn('users','estatus')){
            Schema::table('users', function(Blueprint $table) {
                $table->dropcolumn('estatus');
            });
        }
    }
}
