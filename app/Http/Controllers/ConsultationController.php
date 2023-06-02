<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
//use DB;
use function Psy\debug;

class ConsultationController extends Controller
{
    public function index()
    {
        $role = 3;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $user = User::findOrFail($user_id);
            $role = $user->role;
        }

        $lists = Consultation::where('date_and_time','>',Carbon::today())->paginate(5);
        return view('welcome', compact('lists','role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'info' => 'required',
            'link' => 'required|url',
            'subject' => 'required',
            'type' => 'required',
            'date_and_time' => 'required|after:1 hours',
        ]);
        $date = strtotime($request->date_and_time);
        $date2 = date('Y-m-d H:i', $date);
        $consultation = Consultation::create([
            'user_id' => Auth::user()->id,
            'date_and_time' => $date2,
            'subject' => $request->subject,
            'info' => $request->info,
            'link' => $request->link,
            'type' => $request->type,
        ]);

        $consultation->save();
        return redirect('/home')->with('status', 'Consultation added successfully!');
    }

    public function destroy(int $id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();
        return redirect('/')->with('status', 'Consultation delete successfully!');
    }

    public function search(Request $request)
    {
        $role = 3;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $user = User::findOrFail($user_id);
            $role = $user->role;
        }
        if ($request->search === Null) {
            $lists = Consultation::where('date_and_time', '>', Carbon::today())
                ->paginate(5);
        } else {
            $lists = Consultation::query()
                ->join('users', 'users.id', '=', 'consultations.user_id')
                ->whereNotNull('name')
                ->where('name', $request->search)
                ->orWhere('subject', $request->search)
                ->orWhere('type', $request->search)
                ->orWhere('info', $request->search)
                ->where('date_and_time', '>', Carbon::today())
                ->paginate(5);
        }

        return view('welcome', compact('lists', 'role'));
    }
}
