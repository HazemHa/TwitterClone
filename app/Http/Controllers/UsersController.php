<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\User;
use App\Http\Requests\UsersRequest;
use Validator;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['Logout', 'Login', 'store']]);
    }

    /***Store a newly created resource in storage.*
     *
@param\Illuminate\Http\Request $request *
@return\Illuminate\Http\Response *
     */

    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (\Auth::attempt($credentials)) {
            \Auth::user()->access_token = \Auth::user()->createToken('Token Name')->accessToken;
            $result = \Auth::user()->save();
            return response()->json(['user' => \Auth::user(), 'auth' => $result], 200);
        }

        return response()->json(['message' => 'please check form your credentials'], 401);
    }
    public function Logout()
    {
        \Auth::user()->access_token = null;
        $result = \Auth::user()->save();
        return response()->json(['message' => $result], 200);
    }

    public function updateProfile(Request $request)
    { }
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'cover' => 'required',
            'avatar' => 'required',
            'password' => 'required'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->cover = $request->cover;
        $user->avatar = $request->avatar;
        $date = date_create();
        $timestamp = date_timestamp_get($date);
        if ($request->hasFile('cover')) {
            $nameFile = $request->file('cover')->getClientOriginalName();
            $path = $request->cover->storeAs('public/images/cover', $timestamp . "_" . $nameFile);
            $user->cover =  str_replace("public", "storage", $path);
        }
        if ($request->hasFile('avatar')) {
            $nameFile = $request->file('avatar')->getClientOriginalName();
            $path = $request->avatar->storeAs('public/images/avatar', $timestamp . "_" . $nameFile);
            $user->avatar = str_replace("public", "storage", $path);
        }
        $user->password = bcrypt($request->password);

        $user->access_token = $user->createToken('Token Name')->accessToken;
        $result =  $user->save();
        if ($result) {
            return response()->json(['user' => $user, 'auth' => true], 200);
        }
        return response()->json(['user' => null, 'auth' => false], 200);
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'cover' => 'required',
            'avatar' => 'required',
            'password' => 'required'
        ]);

        $UpdatedRecord = App\Users::find($id);
        $UpdatedRecord->name = $request->name;
        $UpdatedRecord->username = $request->username;
        $UpdatedRecord->email = $request->email;
        $date = date_create();
        $timestamp = date_timestamp_get($date);
        if ($request->hasFile('cover')) {
            $nameFile = $request->file('cover')->getClientOriginalName();
            $path = $request->cover->storeAs('images/cover', $timestamp . "_" . $nameFile);
            $newRecord->cover = $path;
        }
        if ($request->hasFile('avatar')) {
            $nameFile = $request->file('avatar')->getClientOriginalName();
            $path = $request->avatar->storeAs('images/avatar', $timestamp . "_" . $nameFile);
            $newRecord->avatar = $path;
        }
        $UpdatedRecord->password = bcrypt($request->password);
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
            $record = App\User::findOrFail($id);
            $result =  App\User::destroy($record->id);
        } catch (ModelNotFoundException $e) {
            return ['error' => 'there are no data for this record '];
        }

        return $this->createResponseMessage($result);
    }
}
