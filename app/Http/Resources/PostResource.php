<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class PostResource extends JsonResource
    {
        public function toArray( Request $request ): array
        {
            return [
                "id"         => $this->id,
                "user"       => $this->whenLoaded( "user", fn() => UserResource::make( $this->user ) ),
                "title"      => $this->title,
                "updated_at" => $this->updated_at,
                "created_at" => $this->created_at,
                "body"       => $this->body,
                "html"       => $this->html,
                "teaser"     => substr( $this->body, 0, 50 ) . "...",
                "routes"     => [
                    "show" => $this->showRoute(),
                ],
            ];
        }
    }
