@if (\Auth::check())
    <div class="leave-comment">
        <form action="/videos/{{$video->id}}/comments" method="POST" >
            {{csrf_field()}}
            <div class="form-group">
                <div>{{\Auth::user()->name}}</div>
                <input type="text" class="leave-comment-input" name="body" id="comment" placeholder="Leave a comment...">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Leave a comment</button>
            </div>
        </form>
    </div>
    @endif