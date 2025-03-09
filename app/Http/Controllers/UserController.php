<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['dashboard', 'logout']);
    }
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // Redirect if already logged in
        }
        return view('login'); // Show login page if not authenticated
    }
    public function dashboard()
    {
        $users = User::where('role','User')->get();
        return view('assignment/dashboard',compact('users'));
    }
public function registeruser(Request $request)
{

    $request->validate([
        'username' => 'required|string|min:4|max:20|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|numeric|digits:10',
        'password' => 'required|string|min:6|confirmed',
        'profileimg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $profileImage = null;

    if ($request->hasFile('profileimg')) {
        // Store the image and return the path
        $profileImage = $request->file('profileimg')->store('profile_images', 'public');

    }

    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => "Admin",
        'profileimg' => $profileImage,
    ]);

    Auth::login($user);

    return redirect()->route('dashboard')->with('success', 'Registration successful!');
}

// public function loginuser(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required|string',
//     ]);

//     $credentials = $request->only('email', 'password');

//     if (Auth::attempt($credentials)) {
//         $request->session()->regenerate();

//         return redirect()->route('dashboard');
//     }

//     return back()->withErrors([
//         'email' => 'The provided credentials do not match our records.',
//     ]);
// }
public function loginuser(Request $request)
{
    // Validate the request data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Check if the authenticated user has the 'admin' role
        if (Auth::user()->role === 'Admin') {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            // Logout and show an error if the user is not an admin
            Auth::logout();
            return redirect()->back()->withErrors([
                'email' => 'Access denied! Only admins can log in.',
            ]);
        }
    }

    // Authentication failed
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    // public function create(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'username' => 'required|string|max:255|unique:users,username',
    //         'email' => 'required|email|max:255|unique:users,email',
    //         'phone' => 'required|digits:10|unique:users,phone',
    //         'password' => 'required|min:6|confirmed',
    //         'profileimg' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     $profileImage = null;
    //     if ($request->hasFile('profileimg')) {
    //         $profileImage = $request->file('profileimg')->store('profile_images', 'public');
    //     }

    //     $user = User::create([
    //         'username' => $request->username,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => bcrypt($request->password),
    //         'profileimg' => $profileImage,
    //         'role' => 'User', // Default role as Admin
    //     ]);

    //     return response()->json([
    //         'success' => 'User created successfully!',
    //         'user' => [
    //             'id' => $user->id,
    //             'username' => $user->username,
    //             'email' => $user->email,
    //             'phone' => $user->phone,
    //             'profileimg' => $user->profileimg ? 'storage/' . $user->profileimg : null
    //         ]
    //     ]);
    // }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => 'required|min:6|confirmed',
            'profileimg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Added max size validation
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profileImage = null;
        if ($request->hasFile('profileimg')) {
            $profileImage = $request->file('profileimg')->store('profile_images', 'public');
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'profileimg' => $profileImage,
            'role' => 'User',
        ]);

        return response()->json([
            'success' => 'User created successfully!',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone,
                'profileimg' => $user->profileimg ? asset('storage/' . $user->profileimg) : null
            ]
        ]);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
            'phone' => 'required|digits:10',
            'password' => 'nullable|min:6',
            'profileimg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($request->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('profileimg')) {
            if ($user->profileimg) {
                Storage::delete('public/' . $user->profileimg);
            }
            $path = $request->file('profileimg')->store('profile_images', 'public');
            $user->profileimg = $path;
        }

        $user->save();

        return response()->json([
            'success' => 'User updated successfully!',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone,
                'profileimg' => $user->profileimg ? 'storage/' . $user->profileimg : null,
                'password' => '******' // Hide the password
            ]
        ]);
    }


    public function delete(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['error' => 'User not found!'], 404);
        }

        // Delete profile image if exists
        if ($user->profileimg) {
            Storage::delete('public/' . $user->profileimg);
        }

        $user->delete();

        return response()->json(['success' => 'User deleted successfully!']);
    }



    public function exportCSV()
    {
        $response = new StreamedResponse(function () {
            $users = User::where('role','User')->get();
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Name', 'Email', 'Mobile', 'Profile Pic']);
            $i = 1;
            foreach ($users as $user) {
                fputcsv($handle, [$i, $user->username, $user->email, $user->phone, $user->profileimg]);
                $i++;
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="users.csv"');

        return $response;
    }
}
