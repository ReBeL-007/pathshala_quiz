<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRightClickToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
            $table->tinyInteger('rightclick')->default(0);
            $table->tinyInteger('inspect')->default(0);
            $table->string('wel_email')->nullable();
            $table->tinyInteger('w_email_enable')->nullable();
            $table->string('meta_data_desc')->nullable();
            $table->string('meta_data_keyword')->nullable();
            $table->string('google_ana')->nullable();
            $table->tinyInteger('fb_login_enable')->nullable();
            $table->tinyInteger('google_login_enable')->nullable();
            $table->tinyInteger('gitlab_login_enable')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
