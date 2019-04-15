<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Followers;
use App\Http\Requests\FollowersRequest;
use Validator;

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

     public function index(){

     }

     public function follower(){
         return response()->json(['followers'=>\Auth::user()->followers],200);
     }

     public function following(){
        return response()->json(['following'=>\Auth::user()->following],200);
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'follow_id' => 'required'
        ]);



        if (!\Auth::check()) return $this->AuthorizedUser($request);
        $newRecord = new Followers;
        $newRecord->user_id = $request->user_id;
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
            return response()->josn(['message' => 'unauthorized'], 401);
        }
        $UpdatedRecord = App\Followers::find($id);
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
        if (!\Auth::check()) {
            return response()->josn(['message' => 'unauthorized'], 401);
        }

        try {
            $record = App\Followers::findOrFail($id);
            $result =  App\Followers::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'there are no data for this record '];
        }

        return $this->createResponseMessage($result);
    }
}
