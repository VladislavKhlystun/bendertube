@if (count($video->comments))
        @foreach ($video->comments as $comment)
            <div class="single-comment">
                <div class="single-comment__username">
                    <span>
                        {{$comment->user->name}}
                            @if ($comment->user->id == 2)
                                <i class="far fa-check-circle" style="margin-left: 5px;"></i>
                            @endif
                    </span>
                   
                    <span>{{$comment->created_at->diffForHumans()}}</span>
                    @if (Auth::id() == $comment->user->id)
                        <span style="color: red;"> редактировать/удалить (не готово)</span>                    
                    @endif
                </div>
                
                <div class="single-comment__commentbody">
                    {{$comment->body}}
                </div>
                
            </div>
        @endforeach
    @else 
        <h4 class="not_found">Nobody comment this video yet...</h4>
    @endif