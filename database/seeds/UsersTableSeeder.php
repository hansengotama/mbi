<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'role' => 'super_admin',
            'birth_of_date' => Carbon::parse('12/12/1998')->format('Y-m-d H:i:s'),
            'email' => 'superadmin@mbi.com',
            'password' => bcrypt('password'),
            'phone_number' => '081219432066'
        ]);
    }
}
