<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Tweet;
use App\Http\Resources\TweetsResource;

class TweetsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $related = collect();
        foreach (\Auth::user()->following as $user) {
            $related->merge($user->tweets);
        }
        $lastTweets = \App\Tweet::OrderBy('created_at', 'desc')
            ->take(20)->get();
        $tweets = $related->merge($lastTweets);
        return response()->json(['tweets' => TweetsResource::collection($tweets)]);
    }

    public function searchUser($title)
    {
        return User::query()
            ->where('title', 'LIKE', "%{$title}%")
            ->get();
    }

    public function contentTweet($body)
    {
        return \App\Tweet::query()
            ->where('body', 'LIKE', "%{$body}%")
            ->get();
    }


    /***Store a newly created resource in storage.*
     *
@param\Illuminate\Http\Request $request *
@return\Illuminate\Http\Response *
     */


    public function TweetsFromFollowing()
    {


        return \Auth::user()->following[0]->tweets;
    }
    public function myTweets()
    {
        return response()->json(['tweets' => \Auth::user()->tweets], 200);
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'body' => 'required',
        ]);



        if (!\Auth::check()) return $this->AuthorizedUser($request);
        $newRecord = new Tweet;
        $newRecord->body = $request->body;
        $newRecord->user_id = \Auth::user()->id;
        $haveTag = preg_match('/^#(\w+)$/m', $request->body, $tag);
        if ($haveTag) {
            $newRecord->tag = $tag[1];
        }
        $result =  $newRecord->save();
        return response()->json(['tweet'=>new TweetsResource($newRecord),'success'=>true]);
    }

    // this for update record :
    /***
Update the specified resource in storage.**
@param\Illuminate\Http\Request $request *
@param int $id *
@return\Illuminate\Http\Response *
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'body' => 'required',
            'user_id' => 'required'
        ]);



        if (!\Auth::check()) return $this->AuthorizedUser($request);
        $UpdatedRecord = App\Tweet::find($id);
        $UpdatedRecord->body = $request->body;
        $UpdatedRecord->user_id = $request->user_id;
        $result = $UpdatedRecord->save();


        return $this->createResponseMessage($result);
    }

    // this for destroy record :
    /***
Remove the specified resource from storage.*
     *
@param int $id *
 @return\Illuminate\Http\Response
     **/
    public function destroy(Request $request, $id)
    {
        if (!\Auth::check()) return $this->AuthorizedUser($request);
        try {
            $record = App\Tweet::findOrFail($id);
            $result =  App\Tweet::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'there are no data for this record '];
        }

        return $this->createResponseMessage($result);
    }
}
