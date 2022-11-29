<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $id=1;
        $roles=['user','moderator','admin','superadmin'];
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'id'=>$id,
                'role'=>$role
            ]);
            $id+=1;
        }

    }
}
