<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamResults;
use App\User;
use App\Posts;
use Auth;

class ExamResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examresults = User::find( Auth::user()->id )->examresults()->paginate(10);
        $posts = new Posts();

        return view('er.index')->with(['examresults' => $examresults, 'posts' => $posts]);
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

        $result = new ExamResults();
        $result->point = $request->point;
        $result->time = $request->time;
        $result->user_id = $request->user_id;
        $result->post_id = $request->post_id;

        $result->save();

        return "succeed";
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
    public function destroy($id)
    {
        //
    }

    public function userscore()
    {
        $users = User::all();
        $userscores = array();
        foreach ($users as $user) {
            $get = (new ExamResults())->where('user_id', $user->id)->orderBy('point', 'desc')->limit(1)->get();
            if(count($get)>0) {
                array_push($userscores, $get);
            }
        }

        return view('er.userscore')->with(["userscores" => $userscores, "users" => $users]);
    }
}
