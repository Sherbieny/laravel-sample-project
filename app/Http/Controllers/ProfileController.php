<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Notifications\NewFollower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{


    /**
     * @param int $user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory 
     */
    public function index($user)
    {
        $user = User::findOrFail($user);

        return view('profile', [
            'user' => $user
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function triggerFollow(Request $request)
    {
        // dd($request);
        if ($request->follow) {
            $user = User::findOrFail($request->user);
            Auth::user()->following()->attach($user->id);
            $user->notify(new NewFollower(Auth::user()));
            SendEmail::dispatch($user);
        } else {
            $user = User::findOrFail($request->user);
            Auth::user()->following()->detach($user->id);
        }

        return redirect('/u/' . $user->id);
    }
}
