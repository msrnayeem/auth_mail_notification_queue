<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::take(3)->get();
        return view('users.index', compact('users'));
    }
    public function submitSelectedUsers(Request $request)
    {
        $selected = explode(',', $request->input('selectedUserIds'));
        
        // Do something with the selectedUserIds, such as updating the database or performing other actions
        // Example: User::whereIn('id', $selectedUserIds)->update(['status' => 'selected']);
      //  dd($selected);
        return response()->json(['message' => 'Selected users have been processed successfully']);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect back or perform other actions
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Update user data based on $request
        
        // Redirect back or perform other actions
    }
}
