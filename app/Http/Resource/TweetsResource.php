<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TweetsResource extends JsonResource
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

   return new TweetsResource(Tweets::find($id));

 for multi records

return TweetsResource::collection(Tweets::all());
 */
        return [
            'body' => $this->body,
            'user_id' => $this->user_id,
            'id' => $this->id,
            'likesCount'=>$this->likesCount,
            'user' => array(
                'name' => \App\User::find($this->user_id)->name,
                'email' => \App\User::find($this->user_id)->email,
                'avatar' => \App\User::find($this->user_id)->avatar,
                'cover' => \App\User::find($this->user_id)->cover,
                'username' => \App\User::find($this->user_id)->username
            ),
            //       'replies'=>new UsersResource($this->whenLoaded('replies')),
            //       'likes'=>new UsersResource($this->whenLoaded('likes')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
