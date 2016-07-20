<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('user-list', [
            'users' => User::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $me = Auth::user();

        if ($me->id != $id) {
            if ($me->id > 1) {
                return redirect('user/index');
            }

            $user = User::find( $id );
        } else {
            $user = $me;
        }

        return view('user-reset', [
            'user' => $user
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function postUpdate(Request $request, $id)
    {
        $me = Auth::user();

        if ($me->id != $id) {
            if ($me->id > 1) {
                return redirect('user/index');
            }
            
            $user = User::find( $id );
        } else {
            $user = $me;
        }

        $password = $request->input( 'password' );
        if ($password) {
            $password_confirmation = $request->input( 'password_confirmation' );
            
            if ($password != $password_confirmation) {
                return redirect()->back()
                                ->withErrors(['password_confirmation' => '两次输入的密码不一致。']);
            }

            $user->password = bcrypt($password);
        }

        $user->name = $request->input( 'name' );

        $user->save();

        if ($me->id != $id) {
            return redirect('user/index');
        } else {
            return redirect('task/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
