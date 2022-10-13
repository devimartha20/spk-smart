<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class c_user extends Controller
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function index(){
        $user = User::all();
        $pengguna = User::all()->where('role', 0);
        $admin = User::all()->where('role', 1);
        return view('dashboards.admin.kelolaUser', compact('user', 'pengguna', 'admin'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=> $request->role,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin.user.index');
    }

    public function update(Request $request, $id){

        $new = User::find($id);
        $new->name = $request->name;
        $new->email = $request->email;
        $new->password = Hash::make($request->password);
        $new->role = $request->role;
        $new->update();

        return redirect()->route('admin.user.index');
    }

    public function destroy($id){

        $new = User::find($id);
        $new->delete();

        return redirect()->route('admin.user.index');
    }
}
