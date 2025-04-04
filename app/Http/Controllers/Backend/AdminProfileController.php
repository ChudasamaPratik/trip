<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $adminDetails = User::find(Auth::id());
            return view('backend.pages.profile.index', compact('adminDetails'));
        } catch (\Exception $e) {
            return redirect()->route('admin-profiles.index')->with('error', $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);
        try {
            $user = User::find(Auth::id());
            $user->first_name = isset($request->first_name) ? $request->first_name : $user->first_name;
            $user->last_name = isset($request->last_name) ? $request->last_name : $user->last_name;
            if ($request->hasFile('profile_image')) {
                if ($user->image) {
                    Storage::disk('public')->delete('adminProfile_image/' . $user->image);
                }
                $image = $request->file('profile_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('adminProfile_image/', $filename, 'public');
                $user->image = $filename;
            }
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin-profile.index')->with('error', 'Something went wrong');
        }
    }
    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        try {
            $user = User::find(Auth::id());

            if ($request->old_password === $request->password) {
                return back()->withErrors(['password' => 'The new password cannot be the same as the old password.']);
            }

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'The provided password does not match our records.']);
            }

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin-profile.index')->with('error', 'Something went wrong while updating your password.');
        }
    }
}
