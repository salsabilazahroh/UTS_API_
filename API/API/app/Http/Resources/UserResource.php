<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array // Transform resource to array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'token' => $this->whenNotNull($this->token)
        ];
    }
}
