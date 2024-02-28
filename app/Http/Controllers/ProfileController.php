<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id){
        $user_a = $this->user->findOrFail($id);

        return view('user.profile.show')->with('user', $user_a);
    }

    public function edit(){
        return view('user.profile.edit');
    }

    public function update(Request $request){

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50|email|unique:users,email,'.Auth::user()->id,
            //email - email format
            //unique - checks that no other user with the same email
            // when validating (creating) unique: [table],[column]
            //                 (update) unique: [table],[column],[id]
            'introduction' => 'max:100',
            'avatar' => 'max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $user_a = $this->user->findOrFail(Auth::user()->id);

        $user_a->name = $request->name;
        $user_a->email = $request->email;
        $user_a->introduction = $request->introduction;
        if($request->avatar){
            $user_a->avatar = 'data:image/'.$request->avatar->extension().
                                ';base64,'.base64_encode(file_get_contents($request->avatar));
        }
        $user_a->save();

        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function following($id){
        $user_a = $this->user->findOrFail($id);

        return view('user.profile.following')->with('user', $user_a);
    }

    public function followers($id){
        $user_a = $this->user->findOrFail($id);

        return view('user.profile.followers')->with('user', $user_a);
    }

    public function updatePassword(Request $request){

        $user_a = $this->user->findOrFail(Auth::user()->id);

        // check if old/current password is correct
        if(!Hash::check($request->old_password, $user_a->password)){
            //validation error
            return redirect()->back()
                    ->with('incorrect_old_password', 'Current password is incorrect.');
        }
        // new password cannot be the same as current password
        if($request->old_password == $request->new_password){
            //validation error
            return redirect()->back()
                    ->with('same_password_error', 'New password cannot be the same as current password.');
        }

        // confirm password match
        $request->validate([
            'new_password' => 'required|min:8|confirmed|string'
            //string -> input must be in string (letters and numbers)
        ]);

        $user_a->password = Hash::make($request->new_password);
        $user_a->save();

        return redirect()->back()->with('update_success', 'Password changed succesfully!');
    }
}
