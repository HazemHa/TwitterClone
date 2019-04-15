<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TweetsResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  IlluminateHttpRequest  $request
     * @return array
     */
    public function toArray($request)
    {
        /* for one record

   return new UsersResource(Users::find($id));

 for multi records

return UsersResource::collection(Users::all());
 */
        return [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'cover' => $this->cover,
            'avatar' => $this->avatar,
            'password' => $this->password,
            'tweets' => TweetsResource::collection($this->whenLoaded('tweets')),
            'likes' => PostResource::collection($this->whenLoaded('likes')),
            'replies' => ReplyResource::collection($this->whenLoaded('replies')),
            'profile' => new UsersResource($this->whenLoaded('profile')),
            'followers' => UsersResource::collection($this->whenLoaded('followers')),
            'following' => UsersResource::collection($this->whenLoaded('following')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
