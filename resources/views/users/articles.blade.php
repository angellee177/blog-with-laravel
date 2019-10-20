@extends('home')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Blog with Laravel</h2>
            </div>
            <div class="pull-right">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                        <a class="btn btn-success" href="{{ route('articles.create') }}"> Create New Article</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container">
            <div class="row">
                @foreach ($articles as $article)
                <div class="row">
                        <div class="col-md-8 well">
                        <h4 href="{{route('articles.show',$article->id)}}"> {{$article->title}}</h4>
                            <p>
                                {{$article->description}}
                            </p>
                            <p>
                            <span class="quiet"><small>Created {{ $article->created_at }} ago &nbsp by {{$article->user->name}}</small></span>
                            </p>
                            <div class="recipe-actions">
                                    <a class="btn btn-info" href="{{ route('articles.show',$article->id) }}">View details &raquo;</a></p>
                                    @if (Route::has('login') && Auth::user()->id === $article->user_id || Auth::user() === Auth::guard('admin'))
                                    <div class="top-right links">
                                        @auth
                                        <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
                                                <a class="btn btn-primary" href="{{ route('articles.edit',$article->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                  
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        @else
                                            <a href="{{ route('login') }}">Login</a>
                            
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}">Register</a>
                                            @endif
                                        @endauth
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
  
    {{$articles->links()}}
      
@endsection