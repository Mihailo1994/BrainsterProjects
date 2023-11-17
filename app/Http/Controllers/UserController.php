<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        } else {
            return back()->withErrors(['error' => 'Погрешен емаил/лозинка']);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function index(){
        $users = User::select('id', 'firstname', 'lastname', 'email')->where('type', '!=', 'admin')->get();
        return view('users.index', compact('users'));
    }

    public function add(){
        return view('users.add');
    }

    public function store(UserRequest $request){
        $validated = $request->validated();
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $password = Hash::make($request->password);
        $user->password = $password;
        $user->save();

        return redirect()->route('users')->with('status', 'Успешно регистриравте корисник');
    }

    public function delete(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('users')->with('status', 'Успешно го избришавте корисникот');
    }

    public function info($id){
        $user = User::find($id);
        return view('users.info', compact('user'));
    }

    public function password(){
        return view('users.password');
    }

    public function passwordChange(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
        ],
        [
            'old_password.required' => 'Полето за стара лозинка е празно',
            'new_password.required' => 'Полето за нова лозинка е празно',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $user = User::find(Auth::id());
        if (!Hash::check($request->old_password, $user->password)){
            return back()->withErrors('Погрешна стара лозинка');
        } else {
            $user->password = Hash::make($request->new_password);
            return redirect()->route('users.info', Auth::id())->with('status', 'Успешно ја променивте лозинката');
        }

    }
}
