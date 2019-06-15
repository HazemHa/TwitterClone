<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\UsersResource;
use App\Http\Resources\TweetsResource;


class ReplyResource extends JsonResource
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

   return new ReplyResource(Reply::find($id));

 for multi records

return ReplyResource::collection(Reply::all());
 */
        return [
            'id'=>$this->id,
            'body' => $this->body,
            'user_id' => $this->user_id,
            'tweet_id' => $this->tweet_id,
            'user'=>new UsersResource($this->user),
            'tweet'=>new TweetsResource($this->tweet),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
