<?php

namespace App\Http\Controllers;

use File;
use Storage;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class UserProfileController extends Controller
{
    public function show()
    {
        $userDetail = UserDetail::where('user_id', auth()->id())->first();
        return view('userProfile.show', compact('userDetail'));
    }
    public function store(Request $request): RedirectResponse
    {
        try {
            if ($request->hasFile('attachment')) {
                // Validate the file
                $request->validate([
                    'attachment' => 'required|file|mimes:jpeg,png,jpg|max:2048'
                ]);

                $userDetail = UserDetail::where('user_id', auth()->id())->first();

                // Handle case where UserDetail doesn't exist
                if (!$userDetail) {
                    $userDetail = new UserDetail(['user_id' => auth()->id()]);
                } else {
                    $full_path = storage_path("app/public/profile_photos/{$userDetail->photo}");
                    if (file_exists($full_path)) {
                        chmod($full_path, 0775);
                    }
                }

                // Get the file from the correct input name
                $file = $request->file('attachment');

                // Generate filename
                $fileName = str_replace(' ', '_', strtolower(Auth::user()->name)) . '-' . date('Y-m-d') . '.' . $file->getClientOriginalExtension();

                // Store the file
                Storage::disk('public')->put('/profile_photos/' . $fileName, File::get($file));

                // Update user detail
                $userDetail->photo = $fileName;
                $userDetail->save();
            }

            return redirect()->back()->with('success', 'Profile photo uploaded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error uploading file: ' . $e->getMessage());
        }
    }

    }
