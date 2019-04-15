<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Resource\UsersResource;
class ProfilesResource extends JsonResource
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

   return new ProfilesResource(Profiles::find($id));

 for multi records

return ProfilesResource::collection(Profiles::all());
 */
        return [
            'bio' => $this->bio,
            'designation' => $this->designation,
            'company' => $this->company,
            'city' => $this->city,
            'country' => $this->country,
            'user'=>new UsersResource($this->whenLoaded('user')),
            'dob' => $this->dob,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
