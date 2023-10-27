<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request, Feedback $feedback)
{
     $request->validate([
        'feedback_id' => 'required|exists:feedback,id',
        'content' => 'required|string',
        'user_id' => 'required'
    ]);

    Comment::create($request->all());

    return redirect()->back()->with('success', 'Comment added successfully.');
}

    public function getUsers(Request $request)
{
    $query = $request->query('q'); // Get the query parameter for the user's name

    // Fetch users whose names match the query
    $users = User::where('name', 'like', "%$query%")->get();

    return response()->json($users);
}
public function confirm(Request $request, $id)
{
    $action = $request->input('action');
    $comment = Comment::find($id);
    if ($action === 'approve') {
        $comment->update(['confirm' => 1]);
     
    } elseif ($action === 'disapprove') {
        $comment->update(['confirm' => 0]);
    }

    return redirect()->back();
}
public function index()
{
   $comment = Comment::with('user')->paginate(10); // Adjust the pagination as needed
    return view('comments.index', compact('comment'));
}

}
