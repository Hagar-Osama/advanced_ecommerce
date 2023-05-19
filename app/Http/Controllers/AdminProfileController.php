<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAdminPasswordRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAdminProfileRequest;
use App\Http\Traits\UploadTrait;
use Exception;
use Illuminate\Support\Facades\Session;

class AdminProfileController extends Controller
{
    use UploadTrait;
    public function index()
    {
        $profile = Admin::findOrFail(Auth::guard('admin')->user()->id);
        return view('admin.profile.index', compact('profile'));
    }

    public function edit($adminId)
    {
        $profile = Admin::findOrFail($adminId);
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(UpdateAdminProfileRequest $request, int $adminId)
    {
        try {
            $profile = Admin::findOrFail($adminId);
            if ($request->hasFile('profile_photo_path')) {
                $image = $request->file('profile_photo_path');
                $imageName = $image->hashName();
                $this->uploadFiles(
                    $image,
                    'admin/profile/',
                    $imageName,
                    'admin/profile/' . $profile->profile_photo_path
                );
            }
            $profile->update([
                'name' => $request->name,
                'email' => $request->email,
                'profile_photo_path' => $imageName ?? $profile->profile_photo_path

            ]);

            Session::flash('message', 'Profile Updated successfully');
            return redirect()->route('admin.profile');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updatePassword(UpdateAdminPasswordRequest $request)
    {
        try {
            if (Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
                $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
                $admin->update([
                    'password' => Hash::make($request->password)
                ]);
            }
            Session::flash('message', 'Password Updated successfully');
            return redirect()->route('admin.profile');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
