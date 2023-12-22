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

            $posts = Post::factory( 200 )
                         ->has( Comment::factory( 15 )
                                       ->recycle( $users ) )
                         ->recycle( $users )
                         ->create();
            //$comments = ->recycle( $posts )->create();

            User::factory()->create( [
                                         'name'                      => 'Lars Tiefland',
                                         'email'                     => 'ltiefland@gmail.com',
                                         'password'                  => '$2y$12$8xRau4u0HaC5Miw8c2HO7Og9742wC0EM.4EAKiX6zR2jnwp2H/nMa',
                                         'two_factor_secret'         => 'eyJpdiI6Ik1FellDaEdZZkx5dmE0K3Y0OHkvSkE9PSIsInZhbHVlIjoiVHJ1VG15WEVqZmN2ZXVpY2ZjU3FJcnVyYldlY0xOTExKeFUwR2RHeURWWT0iLCJtYWMiOiIxMWY0YTE0YmQ5YjJiN2Y2Y2I4MDVlZDU1NWI4NGIyZjZmNTdhN2VkOTJkOWY5ZjYzOWQ0MDU4NTcxZWJlN2U5IiwidGFnIjoiIn0=',
                                         'two_factor_recovery_codes' => 'eyJpdiI6IlQvT2l6aWlYM081dUxmZDB1ajhjUHc9PSIsInZhbHVlIjoiL0ZsSTFwUm51dDdiTGVaZXJNdVo3YnFObXR4NWVXcHU1VWRCQ3JlZ1ZnTjlObWkvaEtRZUFjdlp1aEhSZGxPNXRBUGVieE04dHJVcnU4WS92QnVCMmdzODgyd1FHZ2RKMnM0MU50dEpCTElMZzRaT0RYS3VDZDhKcUVWaXAzMHRtOUNYUUZoSHVibHdXbUtKN3NpZ1N1MEFMR1BscXZLdHNnQng3aXBlNWFZV3BuVFBTRkppaUVNM2RKSTFUZEZMbmdiOWZPejdZWTY5MlJoekMwK0lvSUJReHUySGxCUmg4NEJiTUQ1cC9LZWZpbFI4WFZ5RWpadE1UMXI5YkRXc1l4Qno2RE8yd1AwYTNuWTlXcTJvUHc9PSIsIm1hYyI6IjM4NGVlZjQyZTRjMDQ3MzI3ZjdjYjlmMDBmNDc1MjExNTJlODc2MDU3OGZkNjQ5NDk0NGMwOWU5YzJkZTcxZDYiLCJ0YWciOiIifQ==',
                                         'two_factor_confirmed_at'   => '2023-12-02 23:55:49',
                                         'remember_token'            => null,
                                         'profile_photo_path'        => 'profile-photos/lbQM2z7AbVlG6APT6ZFdh4PUUbjKEzE9EzVFEJrz.jpg',
                                     ] );
        }
    }
