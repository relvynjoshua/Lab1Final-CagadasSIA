<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use DB;

Class UserController extends Controller 
{
    use ApiResponser;
    private $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    // Get/show users
    public function getUsers()
    {
        //$users = User::all();
        //return response()->json($users, 200);

        $users = DB::connection('mysql')
        ->select("Select * from tbluser");
        return $this->successResponse($users);
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
    
        if ($user->isClean()) {
            return $this->errorResponse("At least one value must change", 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        } 

            $user->save();
            return $this->successResponse($user);
    }

    // Delete user
    public function deleteUser($id) 
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->successResponse('Successfully deleted!');
    }

    // Search user
    public function searchUsers($id){
        $user = User::findOrFail($id);
        return $this->successResponse($user);
    }
}
    

