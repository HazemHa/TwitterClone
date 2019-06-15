<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikesResource extends JsonResource
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

   return new LikesResource(Likes::find($id));

 for multi records

return LikesResource::collection(Likes::all());
 */
        return [
            'user_id' => $this->user_id,
            'tweet_id' => $this->tweet_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
