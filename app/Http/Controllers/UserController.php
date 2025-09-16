<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UserExport;
use App\Models\User;
use Auth;
use PDF;
class UserController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function users(){
        $users = User::paginate(20);
        return view('admin.systemusers',compact('users'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:2|max:80',
            'email' => 'required|min:2|max:80|unique:users',
            'password' => 'required|min:2|max:80',
            'role' => 'required',
        ]);

        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users')->with("success","User has been added succcessfully!");
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|min:2|max:80',
            'email' => 'required|min:2|max:80|unique:users,email,' . $id, // Exclude current email when updating
            'password' => 'nullable|min:2|max:80', // Password is optional for updates
        ]);


        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if ($user->id == 1) {
            $user->role = $user->role;
        } else {
            $user->role = $request->role;
        }
        $user->update();

        return redirect()->route('users')->with("success","User has been updated succcessfully!");
    }
    public function delete($id){
        $user = User::findOrfail($id);
        if ($user->id == 1) {
            return redirect()->route('users')->with("deleted","Main Admin account cannot be deleted!");
        }
    }
    public function login(){
        return view('auth.login');
    }
    public function loginprocess(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|min:5|max:100', // Corrected max:100 with a colon
            'password' => 'required|min:5|max:100',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect to the dashboard with a success message
            // After successful login
            return redirect()->route('home')->with('loginsuccess', 'You have successfully logged in!');

        }

        // Redirect back with an error message if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to login (or homepage)
        return redirect()->route('login');
    }
    public function exportPDFAll(){
        $users = User::all();
        $pdf = PDF::loadView('exportpdfs/usersALLPDF',compact('users'));
        return $pdf->download('Users.pdf');
    }
    public function exportExcel()
    {
        return (new UserExport)->download('Users.xlsx');
    }
}
