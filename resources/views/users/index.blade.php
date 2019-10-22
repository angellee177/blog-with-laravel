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
                                            {{ ++$key }}
                                    </p>
                                    <p>
                                    <span class="quiet"><small>Since {{ $user->created_at }} ago</small></span>
                                    </p>
                                    <div class="recipe-actions">
                                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">View details &raquo;</a></p>
                                            @if (Route::has('login'))
                                            <div class="top-right links">
                                                @if(Auth::guard('admin'))
                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                                            @if($user->isBanned())
                                                                <a href="{{ route('users.revokeuser',$user->id) }}" class="btn btn-success btn-sm"> Revoke</a>
                                                            @else
                                                                <a class="btn btn-success ban btn-sm" data-id="{{ $user->id }}" data-action="{{ URL::route('users.ban') }}"> Ban</a>
                                                            @endif
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
    <script type="text/javascript">
        $("body").on("click",".ban",function(){
    
    
          var current_object = $(this);
    
    
          bootbox.dialog({
          message: "<form class='form-inline add-to-ban' method='POST'><div class='form-group'><textarea class='form-control reason' rows='4' style='width:500px' placeholder='Add Reason for Ban this user.'></textarea></div></form>",
          title: "Add To Black List",
          buttons: {
            success: {
              label: "Submit",
              className: "btn-success",
              callback: function() {
                    var baninfo = $('.reason').val();
                    var token = $("input[name='_token']").val();
                    var action = current_object.attr('data-action');
                    var id = current_object.attr('data-id');
    
    
                    if(baninfo == ''){
                        $('.reason').css('border-color','red');
                        return false;
                    }else{
                        $('.add-to-ban').attr('action',action);
                        $('.add-to-ban').append('<input name="_token" type="hidden" value="'+ token +'">')
                        $('.add-to-ban').append('<input name="id" type="hidden" value="'+ id +'">')
                        $('.add-to-ban').append('<input name="baninfo" type="hidden" value="'+ baninfo +'">')
                        $('.add-to-ban').submit();
                    }
    
    
              }
            },
            danger: {
              label: "Cancel",
              className: "btn-danger",
              callback: function() {
                // remove
              }
            },
          }
        });
    });
    </script>
@endsection