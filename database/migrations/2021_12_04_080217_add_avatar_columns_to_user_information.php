<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvatarColumnsToUserInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_information', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->string('linkedin_avatar')->nullable();
            $table->string('github_avatar')->nullable();
            $table->string('facebook_avatar')->nullable();
            $table->string('google_avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_information', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('linkedin_avatar');
            $table->dropColumn('github_avatar');
            $table->dropColumn('facebook_avatar');
            $table->dropColumn('google_avatar');
        });
    }
}
