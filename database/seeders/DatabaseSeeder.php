<?php

    namespace Database\Seeders;

    // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use App\Models\Comment;
    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            $users = User::factory( 10 )->create();

            $posts = Post::factory( 200 )->recycle( $users )->create();
            $comments = Comment::factory( 100 )->recycle( $users )->recycle( $posts )->create();

            \App\Models\User::factory()->create( [
                'name'     => 'Lars Tiefland',
                'email'    => 'ltiefland@gmail.com',
                'password' => 'UNT_muw.kxt9cjf8tge',
                //'password' => '$2y$12$8xRau4u0HaC5Miw8c2HO7Og9742wC0EM.4EAKiX6zR2jnwp2H/nMa',
            ] );
        }
    }
