<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

public function index()
{
   $user = User::paginate(10); // Adjust the pagination as needed
    return view('user.index', compact('user'));
}

public function destroy($id)
{
    $user = User::find($id);
    if(auth()->user()->role == 'admin'){
    $message = 'You do not delete yourself';
    }
    else{  
    $user->delete();
    $message = 'Deleted Successfull';
}

    return redirect()->back()->with('success', $message );

}

}
    

