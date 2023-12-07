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
                "title"      => $this->title,
                "updated_at" => $this->updated_at,
                "created_at" => $this->created_at,
                "body"       => $this->body,
            ];
        }
    }
