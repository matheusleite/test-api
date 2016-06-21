<?php namespace App\Http\Controllers;

//use Request;
use Illuminate\Http\Request;
use App\User as User;
use PushNotification;
//use App\Http\Requests;

class UsersController extends Controller
{
    public function store(Request $request)
    {
      if (! $request->all())
      {
        //return error and message
        return response()->json([
              'error' => 'failed',
              'message' => 'Parameters failed to create a User'
          ],422);
      }


      //create but not authenticate
//      User::create($request::all());
      User::create($request->all());

      $deviceToken = $request->input('device_token');
      $deviceToken = $request->get('device_token');

      PushNotification::app('appNameIOS')
                ->to($deviceToken)
                ->send('Hello User! Welcome to this app!!!');

      return response()->json([
            'status' => 'success',
            'message' => 'User sucessfully created'
          ],422);
    }
}
