<form method="POST" action="{{ route('comment.store') }}">
    @csrf
    <input type="text" name="feedback_id" value="{{ $feedback->id }}" hidden>
    <textarea name="content" placeholder="Add a comment" required></textarea>
    <button type="submit">Submit Comment</button>
</form>