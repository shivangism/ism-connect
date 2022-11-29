<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsRolesList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_roles_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->references('id')->on('roles')->cascadeOnDelete();
            $table->foreignId('permission_id')->references('id')->on('permissions')->cascadeOnDelete();
            $table->softDeletes();
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
        Schema::dropIfExists('permissions_roles_list');
    }
}
