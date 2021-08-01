<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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


        $buttonEdit= '<a href="'.route('users.edit', ['user'=> $id]).'" id="edit-'.$id.'" class="btn btn-sm btn-primary"><i  class="bi bi-pen"></i></a>&nbsp;';


        $buttonDelete = '<a  href="'.route('users.destroy', ['user'=>$id]).'" title="soft delete" id="delete-'.$id.'" class="ajax btn-warning btn btn-sm "><i class="bi bi-trash"></i></a>&nbsp;';

        $buttonForceDelete = '<a href="'.route('users.destroy', ['user'=> $id]).'?hard=1" title="hard delete" id="forcedelete-'.$id.'" class="ajax btn btn-sm btn-danger"><i class="bi bi-trash"></i> </a>';
        return $buttonEdit.$buttonDelete.$buttonForceDelete;
    }
    public function getUsers()
    {
        $users =  User::select(['id','name','email','user_role','created_at','deleted_at'])->orderBy('name')->withTrashed()->get();
        $result = DataTables::of($users )->addColumn('action', function ($user) {
            return  $this->getUserButtons($user);

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
    public function store(Request $request)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
