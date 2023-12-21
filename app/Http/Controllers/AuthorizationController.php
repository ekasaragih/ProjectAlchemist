<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthorizationController extends Controller
{
    public function index($page)
    {
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}");
        }

        return abort(404);
    }

    // public function login()
    // {
    //     return view("authorization.login");
    // }

    public function register()
    {
        return view("authorization.register");
    }

    public function dashboard_admin()
    {
        // Fetch all users along with their associated groups
        $users = Users::with('userGroup')->get();
    
        return view('pages.dashboard-admin', ['users' => $users]);
    }

    public function getUserData($userID)
    {
        // Retrieve user data based on $userID (from database or any source)
        $user = Users::where('us_ID', $userID)->first();

        // Return user data as JSON
        return response()->json($user);
    }

    public function updateUser(Request $request, $userID)
    {
        // Retrieve the user by ID
        $user = Users::findOrFail($userID);

        // Update the user data with the new values
        $user->us_name = $request->input('us_name');
        $user->us_username = $request->input('us_username');
        // $user->us_email = $request->input('us_email');
        $user->us_stat = $request->input('us_stat');
        $user->grp_ID = $request->input('grp_ID');

        // Save the updated user data
        $user->save();

        return response()->json(['message' => 'User data updated successfully']);
    }

    public function deleteUser($userID)
    {
        // Retrieve the user by ID
        $user = Users::find($userID);

        if (!$user) {
            return response()->json(['success' => false]);
        }

        // Delete the user
        $deleted = $user->delete();

        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forgotpassword()
    {
        return view("authorization.forgot-password");
    }

    public function resetpassword()
    {
        return view("authorization.reset-password");
    }

    public function registerAccount(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'UserID' => 'required',
            'Name' => 'required',
            'Username' => 'required|unique:user,us_username',
            'Email' => 'required|email|unique:user,us_email',
            'Password' => 'required',
            'GrpID' => 'required',
        ]);

        // Create a new user instance
        // $user = User::create($validatedData);

           // Create a new Users instance and fill it with the validated data
           $regist = new Users();
           $regist->us_ID = $validatedData['UserID'];
           $regist->us_name = $validatedData['Name'];
           $regist->us_username = $validatedData['Username'];
           $regist->us_email = $validatedData['Email'];
           $regist->us_pwd = Hash::make($validatedData['Password']);
           $regist->grp_ID = $validatedData['GrpID'];
   
           // Save the registered user to the database
           $regist->save();
        // Redirect or respond as needed
        return redirect()->back()->with('success', 'User registered successfully');
    }

    // public function loginUser(Request $request)
    // {
    //     // Validate incoming login request
    //     $validatedData = $request->validate([
    //         'Username' => 'required',
    //         'Password' => 'required',
    //     ]);
    
    //     $user = Users::where('us_username', $validatedData['Username'])->first();
    
    //     if (!$user || !Hash::check($validatedData['Password'], $user->us_pwd)) {
    //         // If the user does not exist or the password doesn't match
    //         return response()->json(['success' => false, 'message' => 'Invalid credentials']);
    //     }
    
    //     // Password matches, log the user in
    //     Auth::login($user);
    
    //     // Redirect to the home page (dashboard) upon successful login
    //     return response()->json(['success' => true, 'message' => 'Login successful', 'redirect' => route('home')]);
    // }
    
    public function showLoginForm()
    {
        return view('authorization.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('Username', 'Password');
    
        // Validate the credentials
        $validator = Validator::make($credentials, [
            'Username' => 'required',
            'Password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Retrieve the user from the database
        $user = Users::where('us_username', $credentials['Username'])->first();
    
        // Check if user exists and password matches
        if ($user && password_verify($credentials['Password'], $user->us_pwd)) {
            // Attempt to authenticate the user
            if (Auth::loginUsingId($user->us_ID)) {
                // Authentication passed, fetch the authenticated user data
                $authenticatedUser = Auth::user();
                $authenticatedUserName = $authenticatedUser->us_name; // Retrieve the user's name
    
                // Store the authenticated user's name in the session
                session(['authenticatedUserName' => $authenticatedUserName]);
    
                // Redirect to dashboard
                return redirect()->route('dashboard');
            }
        }
    
        // Authentication failed, redirect back with error message
        return redirect()->back()->withErrors(['message' => 'Invalid credentials'])->withInput();
    }    
    

    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
    
    
    

    
}
