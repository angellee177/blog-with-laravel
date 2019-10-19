@foreach (Obj as $article)
                    <div class="col-md-4" style="border:1px;border-style:ridge;margin-right:10px">
                        <h2>{{$article->title}}</h2>
                        <p>{{$article->description}}</p>
                        <div class="pull-right">
                                <p class="center">
                                    <em>Created By:</em>
                                </p>
                                <p class="center">
                                    <small>
                                        {{ $article->user->name }}
                                    </small>
                                    <div class="pull-right">
                                    <div class="pull-right"><small>Created:{{ $article->created_at }}</small>
                                    </div>
                                </p>
                        </div>
                        <div class="recipe-actions">
                            <a class="btn btn-info" href="{{ route('articles.show',$article->id) }}">View details &raquo;</a></p>
                            @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                <a class="btn btn-success" href="{{ route('articles.edit') }}">  Update Article</a>
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
@endforeach