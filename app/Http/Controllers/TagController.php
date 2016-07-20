<?php

namespace App\Http\Controllers;

use DB;
use Config;
use Auth;
use App\Tag;
use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
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
        return view('tag-list', [
            'tags' => Tag::all()
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
    public function postStore(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            $tag = Tag::find( $id );
        } else {
            $tag = new Tag;
        }
        foreach ($request->input('row') as $key => $value) {
            $tag->$key = $value;
        }
        $tag->save( );

        return redirect('tag/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $rows = DB::table('tasks')
        ->select(DB::raw('count(*) as num, department, status'))
        ->where('tag', '=', $id)
        ->groupBy('department')
        ->groupBy('status')
        ->get();

        $s_department = array();
        $departments = Config::get('worktime.department');
        $status = Config::get('worktime.status');
        $default_status = array();
        foreach ($status as $status_id => $value) {
            $default_status[$status_id] = 0;
        }

        $s_all = $default_status;

        foreach ($departments as $department_id => $name) {
            $s_department[$department_id] = $default_status;
        }
        foreach ($rows as $row) {
            $s_department[$row->department][$row->status] = $row->num;

            $s_all[$row->status] += $row->num;
        }

        $rows = DB::table('tasks')
        ->select(DB::raw('count(*) as num, leader, status'))
        ->where('tag', '=', $id)
        ->groupBy('leader')
        ->groupBy('status')
        ->get();

        $s_leader = array();
        foreach ($rows as $row) {
            if (!isset($s_leader[$row->leader])) {
                $s_leader[$row->leader] = $default_status;
            }
            $s_leader[$row->leader][$row->status] = $row->num;
        }

        return view('tag-statistics', [
            'tag' => Tag::find( $id ),
            'users' => User::all()->keyBy( 'id' ),
            's_all' => $s_all,
            's_department' => $s_department,
            's_leader' => $s_leader
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        return view('tag-edit', [
            'tag' => Tag::find( $id )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
