<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Form</title>
    <!-- Add Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Custom CSS -->
    <style>
        /* Custom styling for the form */
        body {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #000000;
            margin: 0 auto;
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
        
            </div>
            <div class="col-md-5">
                <a href="{{ route('feedback.show') }}" class="btn btn-primary">See Feedbacks</a>
            </div>
            </div>
        <h2 class="text-center">FeedBack Submission</h2>
        <form method="POST" action="{{ route('feedback.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
                @if ($errors->has('title'))
                <span class="text-red">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="myTextarea" name="description" rows="5" cols="50" placeholder="Description" >{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                <span class="text-red">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category" id="category" required>
                    <option value="bug">Bug Report</option>
                    <option value="feature">Feature Request</option>
                    <option value="improvement">Improvement</option>
                </select>
                @if ($errors->has('category'))
                <span class="text-red-500">{{ $errors->first('category') }}</span>
                @endif
            </div>
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
      
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>










