<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    
    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Feedback::$rules);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        Feedback::create($request->all());

        return redirect()->route('feedback.create')->with('success', 'Feedback submitted successfully!');
    }
    public function index()
    {
       $feedback = Feedback::with('user')->paginate(10); // Adjust the pagination as needed
        return view('feedback.index', compact('feedback'));
    }
    public function show()
    {
        $feedbacks = Feedback::with('comments','user','comments.user')->get(); // Assuming you have a "comments" relationship in your Feedback model
        return view('feedback.show', compact('feedbacks'));
    }
    public function upvote(Request $request, $id)
{
    $feedback = Feedback::find($id);

    if (!$feedback) {
        return response()->json(['error' => 'Feedback not found'], 404);
    }

    $feedback->vote_count += 1;
    $feedback->update();

    return response()->json(['message' => $feedback->vote_count]);
}
public function destroy(Request $request, $id)
{
    $feedback = Feedback::find($id);
    $feedback->comments()->delete();
    $feedback->delete();

    return redirect()->back();
}

}
