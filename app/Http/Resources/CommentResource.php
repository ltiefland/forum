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
                "updated_at" => $this->updated_at,
                "created_at" => $this->created_at,
                "body"       => $this->body,
            ];
        }
    }
