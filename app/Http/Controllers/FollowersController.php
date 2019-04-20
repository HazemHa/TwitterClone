<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Follower;

class FollowersController extends Controller
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

    public function index()
    { }
    public function suggestedUsers()
    {
        $users = User::orderByRaw('RAND()')->take(10)->get();
        return response()->json(['users' => $users], 200);
    }

    public function follower()
    {
        return response()->json(['users' => \Auth::user()->followers], 200);
    }

    public function following()
    {
        return response()->json(['users' => \Auth::user()->following], 200);
    }



    public function store(Request $request)
    {
        if (\Auth::user()->following->contains('id', (int)$request->follow_id)) {
            $name =  \Auth::user()->following->where('id', (int)$request->follow_id)->first()->name;
            return response()->json(['message' => "you following " . $name], 200);
        }

        $validatedData = $request->validate([
            'follow_id' => 'required'
        ]);
        $newRecord = new Follower;
        $newRecord->user_id = \Auth::user()->id;
        $newRecord->follow_id = $request->follow_id;
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
            'follow_id' => 'required'
        ]);

        if (!\Auth::check()) {
            return response()->json(['message' => 'unauthorized'], 401);
        }
        $UpdatedRecord = App\Follower::find($id);
        $UpdatedRecord->user_id = $request->user_id;
        $UpdatedRecord->follow_id = $request->follow_id;
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
    public function destroy($id)
    {


        try {
            $record = Follower::Where([['follow_id', $id], ['user_id', \Auth::user()->id]])->first();
            $result =  Follower::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'there are no data for this record '];
        }

        return $this->createResponseMessage($result);
    }
}
