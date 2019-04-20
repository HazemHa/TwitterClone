<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Reply;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        return \Auth::user()->replies;
    }

    public function replies()
    {
        return response()->json(['replies' => \Auth::user()->replies], 200);
    }
    /***Store a newly created resource in storage.*
     *
@param\Illuminate\Http\Request $request *
@return\Illuminate\Http\Response *
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'tweet_id' => 'required',
            'body' => 'required'
        ]);


        $newRecord = new Reply;
        $newRecord->body = $request->body;
        $newRecord->user_id = \Auth::user()->id;
        $newRecord->tweet_id = $request->tweet_id;
        $result =  $newRecord->save();
        return $this->createResponseMessage($result);
    }


    // this for destroy record :
    /***
Remove the specified resource from storage.*
     *
@param int $id *
 @return\Illuminate\Http\Response
     **/
    public function destroy($id)
    {

        try {
            $record = Reply::Where([['user_id', \Auth::user()->id], ['id', $id]])->first();
            $result =  Reply::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'there are no data for this record '];
        }

        return $this->createResponseMessage($result);
    }
}
