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
                        @if(Auth::user())
                        <a class="btn btn-success" href="{{ route('articles.create') }}"> Create New Article</a>
                        @elseif(Auth::guard('admin'))
                            <h2>Hi, Admin</h2>
                        @endif
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
                    @if($article->status === 'Rejected')
                        <div class="col-md-8 well">
                        <h4 href="{{route('articles.show',$article->id)}}"> {{$article->title}}</h4>
                            <p>
                                
                                @if (strlen(strip_tags($article->description)) > 10)
                                {{ substr(strip_tags($article->description),0, 1000) }}
                                  ... <a href="{{ route('articles.show',$article->id) }}" class="btn btn-info btn-sm">Read More</a>
                                @endif
                            </p>
                            <p>
                                    <b>status: {{$article->status}}</b>
                            </p>
                            <p>
                            <span class="quiet"><small>Created {{ $article->created_at }} ago &nbsp by {{$article->user->name}}</small></span>
                            </p>
                            <div class="recipe-actions">
                                    @if (Route::has('login') && Auth::id() === $article->user_id || Auth::guest('admin'))
                                    <div class="top-right links">
                                        <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
                                                <a class="btn btn-primary" href="{{ route('articles.edit',$article->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                  
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @else
                                            
                                    </div>
                                    @endif
                            </div>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
    </div>
  

      
@endsection