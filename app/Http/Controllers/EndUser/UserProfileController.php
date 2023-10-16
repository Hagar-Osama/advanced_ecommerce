<?php

namespace App\Http\Controllers\EndUser;

use App\Models\User;
use App\Http\Traits\UploadTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    use UploadTrait;

    public function login(Request $request)
    {
        $data = $request->only(['email','password']);
        if (Auth::attempt($data)) {
            return redirect(route('user.dashboard'));
        }
        session()->flash('error', 'Email Or Password is worng');
        return redirect()->back();
    }
    public function userDashboard()
    {
        return view('dashboard');
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('home'));
    }

    public function edit($locale, $userId)
    {
        // Log::info("User ID: {$userId}, locale: {$locale}");
        $profile = User::findOrFail($userId);
        return view('endUser.profile.edit', compact('profile'));
    }

    public function update(UpdateUserProfileRequest $request, $locale, $userId)
    {
        $profile = User::findOrFail($userId);
        if ($request->hasFile('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            $imageName = $image->hashName();
            $this->uploadFiles(
                $image,
                'user/profile/',
                $imageName,
                'user/profile/' . $profile->profile_photo_path
            );
        }
        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile_photo_path' => $imageName ?? $profile->profile_photo_path
        ]);
        $message = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.dashboard')->with($message);
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {

        if (Hash::check($request->current_password, auth()->guard('web')->user()->password)) {
            $user = User::findOrFail(auth()->guard('web')->user()->id);
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }
        $message = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );
        Auth::logout($user);
        return redirect()->route('login')->with($message);
    }
}
