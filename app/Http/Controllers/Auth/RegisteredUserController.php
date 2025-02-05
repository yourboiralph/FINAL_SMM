<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */

     public function index() {
        $users = User::all();
        return view('pages.admin.users.users', ['users' => $users]);
    }    

    public function create(): View
    {
        return view('pages.admin.users.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $picturePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads');
            $file->move($destination, $file_name);
            $picturePath = 'uploads/' . $file_name;  // Assign to picturePath
        }

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $picturePath, // Save the image path
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users')->with('status', 'Users Created Successfully');
    }

    public function show($id) {
        $user = User::findOrFail($id); // Fetch user or return 404 if not found
        return view('pages.admin.users.show', compact('user'));
    }
    
    public function edit($id)
    {
        $user = User::with('role')->findOrFail($id); // Load role relationship before retrieving the user
        return view('pages.admin.users.edit', compact('user'));
    }

    public function update () {
        
    }
}
