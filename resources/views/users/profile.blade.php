
    @extends('home')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                @if (Route::has('login') && Auth::user() === Auth::guard('admin'))
                    <h2>Admin</h2>
                @elseif(Route::has('login') && Auth::user() !== Auth::guard('admin'))
                    <h2>{{Auth::user()->name}}</h2>
                @endif
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
         <div class="row">
                    <div class="well col-md-8 col-md-offset-2 " >
                            <h4 class="center description" style="text-align:center">
                                <strong>
                                        {{$user->name}}
                                </strong>
                            </h4>
                            <hr/>
                                    {{ $user->email}}
                            <hr/>
                                    <p>Join Since:{{ $user->created_at}}</p>
                            <hr/>
                    </div>
                    @if (Route::has('login') && Auth::user()->id === $user->id|| Auth::guard('admin'))
                    <div class="top-right links">
                        @auth
                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
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
@endsection