<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersIds = App\User::all()->pluck('id');
        
        foreach($usersIds as $id) {
            factory(App\Post::class, rand(1, 20))->create(['user_id' => $id]);
        }
    }
}
