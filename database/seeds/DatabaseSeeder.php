<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$riPOobLnGHIR6eT4E1kGROjsyqdOVoDX8yYEJSso3W7oy5.OXtn/y',
            ]);

            DB::table('ip_lists')->insert([
                    'ip' => '35.230.154.112',
                    'port' => '80',
                    'username' => '',
                    'password' => ''
                ]);
    }
}
