<ul class="list-unstyled">
    @foreach($microposts as $micropost)
        <li class="media mb-3">
            <!--画像を表示-->
            <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show',$micropost->user->name, ['id' => $micropost->user->id]) !!}
                    <span class="text-muted">posted at{{ $micropost->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                </div>
                
                    <div class="row d-flex justify-content-start">
                        <!--お気に入りに追加済みならunfavoriteボタンを表示-->
                        <div class="col-sm-4 col-md-3">
                            @if (Auth::User()->favoring($micropost->id))
                                {!! Form::open(['route' => ['delete_favorites.favorite', $micropost->id],
                                'method' => 'delete']) !!}
                                    {!! Form::submit('unfavorite', ['class' =>'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                            
                            <!--お気に入りに未追加ならfavoriteボタンを表示-->
                            @if (!Auth::User()->favoring($micropost->id))
                                {!! Form::open(['route' => ['add_favorites.favorite', $micropost->id],
                                'method' => 'post']) !!}
                                    {!! Form::submit('favorite', ['class' =>'btn btn-primary btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                        <div class="col-sm-4 col-md-1">
                            @if (Auth::id() == $micropost->user_id)
                                {!! Form::open(['route' => ['microposts.destroy', $micropost->id],
                                'method' => 'delete']) !!}
                                    {!! Form::submit('Delete', ['class' =>'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                        
                    </div>
                
            </div>
        </li>
    @endforeach
</ul>
{{ $microposts->render('pagination::bootstrap-4') }}
