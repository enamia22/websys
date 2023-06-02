<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $current_user = User::findOrFail($user_id);
            $users = User::paginate(5);
            return view('home', compact('current_user','users'));
        }
    }

    public function destroy(int $id)
    {
        $user_id = Auth::user()->id;
        if ($id != $user_id) {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect('home')->with('status', 'User delete successfully!');
        } else {
            return redirect('home')->with('status', 'Cant delete current user!');
        }
    }

    public function approve(int $id)
    {
        $user = User::findOrFail($id);
        User::where('id',$id)->update(['approved' => !$user->approved]);
        return redirect('home')->with('status', 'User updated successfully!');
    }
}
