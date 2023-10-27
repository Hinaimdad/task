<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/6/tinymce.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <meta charset='utf-8'>
  <style>
        body {
            background-color: #f2f2f2;
        }
        .container {
            margin-top: 30px;
        }
        .feedback-item {
            border: 1px solid #ddd;
            background-color: #fff;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
        }
        .vote-buttons button {
            margin-right: 10px;
        }
        .comment-section {
            margin-top: 10px;
        }
        :root {
        font: 400 2ch/1.25 Consolas;
      }
    </style>
 
</head>
<body>
    <div class="container">
    <div class="row">
    <div class="col-md-10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    <div class="col-md-2">
        <a href="{{ route('feedback.create') }}" class="btn btn-primary">Add Feedback</a>
    </div>
    </div>

        <h2>Feedback</h2>
        <div class="feedback-list">
            <!-- Feedback Item 1 -->
            @foreach($feedbacks as $feedback)
            <div class="feedback-item" @if($loop->index >= 3) style="display: none;" @endif>
                <p><strong>@if($feedback->user != null){{ $feedback->user->name }}@endif:</strong> {{ $feedback->description }}</p>
                <div class="vote-buttons">
                    <button class="btn btn-sm btn-primary upvote-button" data-feedback-id="{{ $feedback->id }}">Upvote</button>
                    <span class="vote-count">{{ $feedback->vote_count }}</span> Upvotes
                </div>
                <div class="comment-section">
                    <h4>Comments</h4>
                    @foreach($feedback->comments as $comment)
                    @if($comment->confirm == '1')
                            <div class="comment" @if($loop->index >= 3) style="display: none;" @endif>
                               
                              <div class="row">
                                <div class="col-lg-10">
                                    <strong>{{ $comment->user->name }} </strong>
                                </div>
                                <div class="col-lg-2">
                                    <span style="color:gray">  {{ $comment->created_at->format('j M Y') }} </span>
                                </div>
                            </div>
                                   <p>   {!!$comment->content !!} </p>
                            </div>
                        @endif
                        @endforeach
 
                        @if(count($feedback->comments) > 3)
                            <button class="show-more-comments" style="background-color: transparent;border:none;">Show More</button>
                        @endif
                   
                    <form action="{{ route('comment.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                            <fieldset id="editor" name="content" class="form-control" contenteditable="true"></fieldset>
                            <fieldset>
                                <button type="button" class="fontStyle" onclick="document.execCommand('italic',false,null);" title="Italicize Highlighted Text"><i>I</i>
                                </button>
                                <button type="button" class="fontStyle" onclick="document.execCommand( 'bold',false,null);" title="Bold Highlighted Text"><b>B</b>
                                </button>
                                <button type="button" class="fontStyle" onclick="document.execCommand( 'underline',false,null);" title='Underline Highlighted Text'><u>U</u>
                                </button>
                              </fieldset>

                        </div>
                        <div id="mention-list" class="mention-list"></div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
           @endforeach
        <div class="pb-5">
           <button class="show-more-feedback btn-secondary">Show More Feedback</button>  
        </div>
    </div>
    <script>
       
        tinymce.init({
  selector: "#editor",
  plugins: "emoticons autoresize",
  toolbar: "emoticons",
  toolbar_location: "bottom",
  menubar: false,
  statusbar: false
});

    </script>

    <script>
        document.querySelectorAll('.upvote-button').forEach(function(button) {
            button.addEventListener('click', function() {
                const feedbackId = this.getAttribute('data-feedback-id');
    
                // Send an AJAX request to the upvote route
                fetch(`/feedback/${feedbackId}/upvote`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    // Update the vote count display on the page
                    const voteCountElement = this.closest('.feedback-item').querySelector('.vote-count');
                    voteCountElement.textContent = data.message;
                })
                .catch(error => {
                    console.error(error);
                });
            });
        });
    </script>
   
    
    <script>
              document.querySelector('.show-more-comments').addEventListener('click', function() {
            document.querySelectorAll('.comment').forEach(function(item) {
                item.style.display = 'block';
            });
            this.style.display = 'none';
        });
    </script>
    
    <script>
    
        document.querySelector('.show-more-feedback').addEventListener('click', function() {
            document.querySelectorAll('.feedback-item').forEach(function(item) {
                item.style.display = 'block';
            });
            this.style.display = 'none';
        });
    </script>
   
<script>
  $(document).ready(function () {
    window.EmojiPicker.init()
    var mentionList = $('#mention-list');

    $('#comment').mentionsInput({
        onDataRequest: function (mode, query, callback) {
            if (mode === 'mentions') {
                // Make an AJAX request to get user mentions based on the query
                $.ajax({
                    url: '/get-users?q=' + query,
                    method: 'GET',
                    success: function (data) {
                        callback.call(this, data);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        },
        // Rest of your mentionsInput configuration
    });
    
    // Rest of your JavaScript code for showing/hiding the mention dropdown
});

</script>    
  
</body>
</html>
