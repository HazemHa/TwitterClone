<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Tweet;
use App\Http\Requests\TweetsRequest;
use Validator;

class TweetsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
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
            'user_id' => 'required'
        ]);



        if (!\Auth::check()) return $this->AuthorizedUser($request);
        $newRecord = new Tweets;
        $newRecord->body = $request->body;
        $newRecord->user_id = $request->user_id;
        $result =  $newRecord->save();
        return $this->createResponseMessage($result);
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
        $UpdatedRecord = App\Tweets::find($id);
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
            $record = App\Tweets::findOrFail($id);
            $result =  App\Tweets::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'there are no data for this record '];
        }

        return $this->createResponseMessage($result);
    }
}
