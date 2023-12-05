    <?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\JsonResource;

    class UserResource extends JsonResource
    {
        public function toArray(Request $request):array
        {
            return [
                "id"=>$this->id,
            ];
        }
    }
