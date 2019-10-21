@extends('layouts.auth')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Article</h2>
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
   

<div class="container">
    <div class="row">
                <div class="col-md-12">
                        <form action="{{ route('articles.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <strong>Title:</strong>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="title" class="form-control" placeholder="Title"', autofocus: true>
                            </div>
                        </div>
                </div>
                <br>
                <div class="col-md-12">
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <strong>Description:</strong>
                            </div>
                            <div class="col-md-8">
                                    <textarea class="form-control" autofocus:true style="height:150px" name="description" placeholder="Description"></textarea>
                            </div>
                        </div>
                    <div class="col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-primary" href="{{ route('articles.index') }}">Cancel</a>
                    </div>
                </div>
    </div>

   
</form>
@endsection