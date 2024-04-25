<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['register', 'store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users', [
            'title' => 'User',
            'users' => User::orderBy('name')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register', [
            'title' => 'Registrasi',
        ]);
    }

    public function register(){
        return view('auth.guest', [
            'title' => 'Register',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'level' => '',
            'password' => 'required|min:8',
        ], [
            'name.unique' => 'Username ini sudah digunakan',
            'email.unique' => 'Email ini sudah digunakan'
        ]);
        
        $user = User::create($validated);

        if(!$user->level){
            return redirect('/login')->with('success', 'Berhasil registrasi, login sekarang !');
        }

        return redirect('/user')->with('success', 'Akun Baru berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->id === Auth::id()){
            return back()->with('fail', 'TIdak bisa hapus akun sendiri!');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }
}
