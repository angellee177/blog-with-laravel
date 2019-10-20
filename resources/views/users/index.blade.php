@extends('users.layout')
 
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
                        <a class="btn btn-success" href="{{ route('users.show', Auth::id() ) }}"> Profile</a>
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
                    
                        @foreach ($users as $user)
                        <div class="row">
                                <div class="col-md-8 well">
                                <h4 href="{{route('users.show',$user->id)}}"> {{$user->name}}</h4>
                                    <p>
                                        {{$user->email}}
                                    </p>
                                    <p>
                                    <span class="quiet"><small>Since {{ $user->created_at }} ago</small></span>
                                    </p>
                                    <div class="recipe-actions">
                                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">View details &raquo;</a></p>
                                            @if (Route::has('login'))
                                            <div class="top-right links">
                                                @auth
                                                {{-- @can('delete', $article) --}}
                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                        @can('update', $user)
                                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                                        @endcan
                                                        @csrf
                                                        @method('DELETE')
                                        
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                {{-- @endcan --}}
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
  
@endsection