<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Article;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use App\Notifications\newUserPost;
use Illuminate\Support\Facades\Notification;

use Auth;

// for Yajra data table
use Redirect,Response,DB,Config;
use Datatables;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        
    }

    public function index()
    {
           
        $articles  =Article::latest()->paginate(5);
        return view('articles.index', compact('articles'))
            ->with('i', (request()->input('page', 1)- 1) * 5);
    }

    public function indexApproved()
    {
                $articles  =Article::all();
                return view('articles.approved', compact('articles'));
    }

    public function indexRejected()
    {
                $articles  =Article::all();
                return view('articles.rejected', compact('articles'));
    }

    public function indexPending()
    {
        if(Auth::guest('admin')){
            $articles  =Article::all();
                return view('articles.pending', compact('articles'));
        }else{
            return redirect()->route('users.profile')
                ->with('success', 'cannot access this feature');
        }
                
    }
    // for admin
    public function indexAdmin()
    {
        return view('articles.indexAdmin');
    }

    public function articlesAdmin()
    {
        $articles = DB::table('articles')->select('*');
        return datatables() ->   of($articles)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    
                                            return $btn;
                                    })
                            ->rawColumns(['action'])
                            ->  make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Admin $admin)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->user_id = Auth::id();
        $article->save();

        $admin = Auth::guest('admin');
        Notification::route('mail', 'leexiao62@gmail.com')
            ->route('nexmo', '5555555555')
            ->notify(new NewUserPost($article));
        // Notification::send($admin, new NewUserPost($article));
        return redirect()->route('articles.index')
                        ->with('success', 'articles created successfully');
        
    }

    public function statusUpdate(Request $request, Article $article)
    {
        $article->status = $request->status;
        $article->update();

        return redirect()
            ->route('articles.index')
            ->withMessage('Articles approved successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // $article ->get()->find($article->id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Article $article)
    {

            $article->title = $request->title;
            $article->description = $request->description;
            $article->status = $request->status;

        $article->update();

        return redirect()->route('articles.index')
                        ->with('success', 'Articles updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {   
        $article->delete();
        return redirect()->route('articles.index')
                        ->with('success', 'Article deleted successfully');
    }
}
