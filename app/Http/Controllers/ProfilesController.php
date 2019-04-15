<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Profiles;
use App\Http\Requests\ProfilesRequest;
use Validator;

class ProfilesController extends Controller
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

    public function myProfile(){

    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'bio' => 'required',
            'designation' => 'required',
            'company' => 'required',
            'city' => 'required',
            'country' => 'required',
            'dob' => 'required',
        ]);


        $newRecord = new Profiles;
        $newRecord->bio = $request->bio;
        $newRecord->designation = $request->designation;
        $newRecord->company = $request->company;
        $newRecord->city = $request->city;
        $newRecord->country = $request->country;
        $newRecord->dob = $request->dob;
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
            'bio' => 'required',
            'designation' => 'required',
            'company' => 'required',
            'city' => 'required',
            'country' => 'required',
            'dob' => 'required',
        ]);





        $UpdatedRecord = App\Profiles::find($id);
        $UpdatedRecord->bio = $request->bio;
        $UpdatedRecord->designation = $request->designation;
        $UpdatedRecord->company = $request->company;
        $UpdatedRecord->city = $request->city;
        $UpdatedRecord->country = $request->country;
        $UpdatedRecord->dob = $request->dob;
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
    public function destroy($id)
    {

        try {
            $record = App\Profiles::findOrFail($id);
            $result =  App\Profiles::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'there are no data for this record '];
        }

        return $this->createResponseMessage($result);
    }
}
