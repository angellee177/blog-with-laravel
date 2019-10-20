<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Article;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');  

    }

    public function index()
    {
        $users  =User::latest()->paginate(5);
        return view('users.index', compact('users'))
            ->with('i', (request()->input('page', 1)- 1) * 5);
    }

    public function articles(Request $request)
    {
        $user = Auth::user();

        $articles = Article::where('user_id', $user->id)->paginate(5);;
        return view('users.articles', compact('articles'))
            ->with('i', (request()->input('page', 1)- 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {

        $user->name = $request->name;
        $user->update();

        return redirect()->route('users.index')
                        ->with('success', 'Users updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        $user->delete();
        return redirect()->route('users.index')
                        ->with('success', 'User deleted successfully');
    }
}
