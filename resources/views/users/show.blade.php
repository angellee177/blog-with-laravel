@extends('home')
@section('content')
<div class="container">
        <div class="well col-md-8 col-md-offset-2 " >
            <h4 class="center description" style="text-align:center">
                <strong>
                        {{$user->name}}
                </strong>
            </h4>
            <hr/>
                    {{ $user->email}}
            <hr/>
                    {{-- {{ $user->->title}} --}}
            <hr/>
        </div>
        <div class="recipe-actions">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
        
    </div>
@endsection