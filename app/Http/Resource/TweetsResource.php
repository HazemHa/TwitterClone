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
     //       'user'=>new UsersResource($this->whenLoaded('user')),
     //       'replies'=>new UsersResource($this->whenLoaded('replies')),
     //       'likes'=>new UsersResource($this->whenLoaded('likes')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
