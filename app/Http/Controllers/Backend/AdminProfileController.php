<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
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
            $adminDetails = User::with('userDetails')->find(Auth::id());
            return view('backend.pages.profile.index', compact('adminDetails'));
        } catch (\Exception $e) {
            return redirect()->route('admin-profiles.index')->with('error', $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        // Validate input
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'string|max:50',
            'phone' => 'digits:10',
            'city' => 'string|max:50',
            'state' => 'string|max:50',
            'country' => 'string|max:50',
            'zipcode' => 'digits:6',
            'agency_name' => 'string|max:50',
            'description' => 'string|max:100',

        ]);

        try {

            $user = Auth::user();
            $userDetails = $user->userDetails;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;

            if ($request->hasFile('profile_image')) {

                if ($user->image) {
                    Storage::disk('public')->delete('Profile_image/' . $user->image);
                }
                // Upload new image
                $image = $request->file('profile_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('Profile_image/', $filename, 'public');
                $user->image = $filename;
            }

            $user->save();

            if ($userDetails) {
                $userDetails->address = $request->address;
                $userDetails->phone = $request->phone;
                $userDetails->city = $request->city;
                $userDetails->state = $request->state;
                $userDetails->country = $request->country;
                $userDetails->zipcode = $request->zipcode;
                $userDetails->agency_name = $request->agency_name;
                $userDetails->description = $request->description;
                $userDetails->save();
            } else {
                $details = new UserDetail();
                $details->id = Str::uuid();
                $details->user_id = $user->id;
                $details->address = $request->address;
                $details->phone = $request->phone;
                $details->city = $request->city;
                $details->state = $request->state;
                $details->country = $request->country;
                $details->zipcode = $request->zipcode;
                $details->agency_name = $request->agency_name;
                $details->description = $request->description;
                $details->save();
            }
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
