<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TweetsResource;
class TagResource extends JsonResource
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
            'id' => $this->body,
            'body' => $this->user_id,
            'tweet_id' => $this->tweet_id,
            'tweet'=> new TweetsResource(\App\Tweet::find($this->tweet_id))
        ];
    }
}
