<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Tweet;
use App\Tag;
use App\Http\Resources\TweetsResource;
use App\Http\Resources\ReplyResource;

class TweetsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function likeOrDisLike(Request $request,$tweetID){
        $tweet = \App\Tweet::find($tweetID);
        $result = $tweet->toggleLikeBy();

        return response()->json(['result'=>$result],200);
    }

    public function index(Request $request)
    {
        $related = collect();
        $replies =  ReplyResource::collection(\App\Reply::all());
        foreach (\Auth::user()->following as $user) {
            $related->merge($user->tweets);
        }
        $data = \App\Tweet::OrderBy('created_at', 'desc')
            ->take(20)->get();
        $tweetsR = TweetsResource::collection($data);
        $part1 = $replies->merge($tweetsR);
        $tweets = $related->merge($part1);

        return response()->json(['tweets' => $tweets],200);
    }

    public function tweetsTag($text)
    {
           $data = Tag::where('body',$text)->first()->tweets;
           return TweetsResource::collection($data);
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
        return response()->json(['tweets' => TweetsResource::collection(\Auth::user()->tweets)], 200);
    }
    public function TagsData()
    {

        $collection = \App\Tag::all();
        $grouped = $collection->map(function ($item, $key) {
            return ['name'=>$item->body,'count'=> count($item->tweets)];
        });
        $sorted = $grouped->sortByDesc(function ($value) {
            return $value['count'];
        });
        return response()->json(['data' => $sorted->take(7)], 200);

    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $newRecord = new Tweet;
        $haveTag = preg_match('/^#(\w+)$/m', $request->body, $tagBody);
        $newRecord->body = $request->body;
        $newRecord->user_id = \Auth::user()->id;
        if ($haveTag) {
            $tag = Tag::firstOrCreate(['body'=>$tagBody[1]]);
            $newRecord->tag_id = $tag->id;
        }
        $result = $newRecord->save();
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
