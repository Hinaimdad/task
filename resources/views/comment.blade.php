<div class="comment">
    <strong>{{ $comment->user_name }}</strong>
    <p>{!! $parsedown->text($comment->content) !!}</p>
</div>
