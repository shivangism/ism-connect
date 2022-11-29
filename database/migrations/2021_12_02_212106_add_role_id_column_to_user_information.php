<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleIdColumnToUserInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_information', function (Blueprint $table) {
            $table
                ->foreignId('role_id')->default(1)
                ->references('id')
                ->on('roles')
                ->cascadeOnDelete();
            // $table
            //     ->foreignId('role_id')
            //     ->default(1)
            //     ->change();
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
            $table->dropForeign('user_information_role_id_foreign');
            $table->dropColumn('role_id');
        });
    }
}
