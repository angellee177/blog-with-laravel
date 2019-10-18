@extends('articles.layout')
 
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
   
    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Author</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->title }}</td>
            <td>{{ $article->description }}</td>
            <td>{{ $article->status}}</td>
            <td>{{ $article->user_id}}</td>
            <td>{{ $article->created_at}}</td>
            <td>{{ $article->updated_at}}</td>
            <td>
                <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('articles.show',$article->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('articles.edit',$article->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $articles->links() !!}
      
@endsection