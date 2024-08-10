<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin/users');
    }
    private function getUserButtons(User $user)
    {
        $id = $user->id;


        $buttonEdit= '<a href="#" style="cursor: default" disabled class="btn  btn-sm  btn-info"> <i  class="bi bi-pen"></i></a>';
         if($user->deleted_at){
             $deleteRoute = route('admin.userrestore', ['user' => $id]);
             $btnClass = 'btn-default';
             $iconDelete = '<i class="bi bi-arrow-counterclockwise"></i>';
             $btnId = 'restore-'.$id;
         } else {
             $buttonEdit= '<a href="'.route('users.edit', ['user'=> $id]).'" id="edit-'.$id
                 .'" class="btn btn-sm btn-primary"><i  class="bi bi-pen"></i></a>&nbsp;';
             $deleteRoute = route('users.destroy', ['user' => $id]);
             $iconDelete = '<i class="bi bi-trash"></i>';
             $btnClass = 'btn-warning';
             $btnId = 'delete-'.$id;
         }

        $buttonDelete = "<a  href='$deleteRoute' title='soft delete' id='$btnId' class='ajax $btnClass btn btn-sm'>$iconDelete</a>&nbsp;";

        $buttonForceDelete = '<a href="'.route('users.destroy', ['user'=> $id])
            .'?hard=1" title="hard delete" id="forcedelete-'.$id
            .'" class="ajax btn btn-sm btn-danger"><i class="bi bi-trash"></i> </a>';

        return $buttonEdit.$buttonDelete.$buttonForceDelete;
    }
    public function getUsers()
    {
        $users =  User::select(['id','name','email','user_role','created_at','deleted_at'])->orderBy('name')->withTrashed()->get();
        $result = DataTables::of($users )->addColumn('action', function ($user) {
            return  $this->getUserButtons($user);

        })->editColumn('created_at', function($user ){
            return $user->created_at? $user->created_at->format('Y-m-d H:i') : '';
        })
            ->editColumn('updated_at', function($user ){
                return $user->updated_at? $user->updated_at->format('Y-m-d H:i') : '';
            })->editColumn('deleted_at', function($user ){
                return $user->deleted_at? $user->deleted_at->format('Y-m-d H:i') : '';
            })->make(true);
        return $result;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
       $user->name = $request->name;
        $user->email = $request->email;
        $user->user_role = $request->user_role;
        $res = $user->save();
        $message = $res ? 'User modified': 'Problem updating user';
        session()->flash('message', $message);
      return  redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $req)
    {
        $user = User::withTrashed()->findOrFail($id);
        $res = $req->hard ? $user->forceDelete(): $user->delete();
        return ''.$res;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id

     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $res =  $user->restore();
        return ''.$res;
    }
}
