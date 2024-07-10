<?php

    namespace App\Http\Resources;

    use App\Models\Like;
    use Illuminate\Support\Number;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class PostResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray( Request $request ): array
        {
            return [
                'id'          => $this->id,
                'user'        => UserResource::make( $this->whenLoaded( 'user' ) ),
                'topic'       => TopicResource::make( $this->whenLoaded( 'topic' ) ),
                'title'       => $this->title,
                'body'        => $this->body,
                'html'        => $this->html,
                'likes_count' => Number::format( $this->likes_count, null, null, 'de_DE' ),
                'updated_at'  => $this->updated_at,
                'created_at'  => $this->created_at,
                'routes'      => [
                    'show' => $this->showRoute(),
                ],
                'can'         => [
                    'like' => $request->user()?->can( 'create', [ Like::class ], $this->resource ),
                ],
            ];
        }
    }
