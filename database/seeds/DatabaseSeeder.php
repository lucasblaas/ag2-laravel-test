<?php

use Illuminate\Database\Seeder;

use \App\Company;
use \App\Group;
use \App\User;

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
        $this->call('CompaniesTableSeeder');
        $this->call('GroupsUsersTableSeeder');
    }

}

class CompaniesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('companies')->delete();

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $company = Company::create([
                'name' => $faker->name
            ]);

        }
    }
}

class GroupsUsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('group_user')->delete();
        DB::table('groups')->delete();
        DB::table('users')->delete();

        $faker = Faker\Factory::create();

        $group = Group::create([
            'name' => $faker->name
        ]);

        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@teste.com',
            'password' => bcrypt('123456'),
            'active' => 1
        ]);

        $user->groups()->save($group);
    }

}

