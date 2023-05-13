<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;

Class UserController extends Controller 
{
    private $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    // Get/show users
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    // Add users
    public function addUsers(Request $request )
    {
        
        $rules = [
            $this->validate($request, [
                'username' => 'required|max:20',
                'password' => 'required|max:20'
            ])
        ];

        $this->validate($request,$rules);

        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    // Update users
    public function updateUser(Request $request, $id) 
    {
        
        $rules = [
            $this->validate($request, [
                'username' => 'required|max:20',
                'password' => 'required|max:20'
            ])
        ];
    
        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        $user->fill($request->all());
    
        $user->save();

        return $user;
    }

    // Delete user
    public function deleteUser($id) 
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
    

