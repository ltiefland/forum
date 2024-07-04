<?php

    namespace Database\Factories;

    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
     */
    class LikeFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'user_id'       => User::factory(),
                'likeable_id'   => $this->likeableType( ... ),
                'likeable_type' => Post::class,
            ];
        }

        protected function likeableType( $values ): string
        {
            $type = $values['likeable_id'];
            $modelName = $type->modelName();
            return ( new $modelName )->getMorphClass();
        }
    }
