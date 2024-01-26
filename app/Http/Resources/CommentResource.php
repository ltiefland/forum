<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class CommentResource extends JsonResource
    {
        public function toArray( Request $request ): array
        {
            return [
                "id"         => $this->id,
                "user"       => $this->whenLoaded( "user", fn() => UserResource::make( $this->user ) ),
                "post"       => $this->whenLoaded( 'post', fn() => PostResource::make( $this->post ) ),
                "updated_at" => $this->updated_at,
                "created_at" => $this->created_at,
                "body"       => $this->body,
                "can"        => [
                    "update" => $request->user()?->can( 'update', $this->resource ),
                    "delete" => $request->user()?->can( 'delete', $this->resource ),
                ],
            ];
        }
    }
