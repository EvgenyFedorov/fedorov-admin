<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data[] = [
            'parent_user' => 0,
            'name' => "Супер Администратор",
            'roles_id' => 1,
            'tariff_id' => 1,
            'email' => "rsa-team@yandex.ru",
            'email_verified_code' => "",
            'password' => bcrypt('root'),
            'enable' => 1,
            'remember_token' => Str::random(10),
            'started_at' => null,
            'stopped_at' => null,
            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        $data[] = [
            'parent_user' => 1,
            'name' => "Администратор",
            'roles_id' => 2,
            'tariff_id' => 1,
            'email' => "rsa-team2@yandex.ru",
            'email_verified_code' => "",
            'password' => bcrypt('root'),
            'enable' => 1,
            'remember_token' => Str::random(10),
            'started_at' => null,
            'stopped_at' => null,
            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        $data[] = [
            'parent_user' => 2,
            'name' => "Менеджер",
            'roles_id' => 3,
            'tariff_id' => 1,
            'email' => "rsa-team3@yandex.ru",
            'email_verified_code' => "",
            'password' => bcrypt('root'),
            'enable' => 1,
            'remember_token' => Str::random(10),
            'started_at' => null,
            'stopped_at' => null,
            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        $data[] = [
            'parent_user' => 1,
            'name' => "test",
            'roles_id' => 4,
            'tariff_id' => 1,
            'email' => "test@yandex.ru",
            'email_verified_code' => "",
            'password' => bcrypt('root'),
            'enable' => 1,
            'remember_token' => Str::random(10),
            'started_at' => null,
            'stopped_at' => null,
            'updated_at' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'deleted_at' => null,
        ];

        DB::table('users')->insert($data);

    }
}
