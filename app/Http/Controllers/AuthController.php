<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        if (session('user')) {
            return redirect()->route('index');
        } else {
            return view('auth.login', ['message' => '']);
        }
    }

    public function loginUser(Request $request) {
        $user = User::where('login', $request->login)->first();
        if(!$user) return view('auth.login', ['message' => 'Неверный логин или пароль']);
        if (!Hash::check($request->password, $user->password)) {
            return view('auth.login', ['message' => 'Неверный пароль']);
        }
        session()->put('user', serialize($user)); 
        return redirect()->route('index');
    }

    public function logout() {
        session()->forget('user');
        return redirect()->route('index');
    }

    public function register() {
        if (session('user')) {
            return redirect()->route('index');
        } else {
            return view('auth.register');
        }
    }

    public function registerUser(Request $request) {
        $validatedData = $request->validate([
            'login' => 'required|unique:users|max:255|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
            'secret-word' => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ], [
            'login.required' => 'Поле "логин" обязательное.',
            'login.unique' => 'Пользователь с таким логином уже есть.',
            'login.max' => 'Ваш логин слишком длинный.',
            'login.regex' => 'Логин может состоять только из латинских букв и цифр.',
            'password.required' => 'Поле "пароль" обязательное.',
            'password.min' => 'Минимальная длинна пароля - 8 символов.',
            'confirm-password' => 'Ошибка в подтверждении пароля.',
            'secret-word.required' => 'Поле "секретное слово" обязательное.',
            'g-recaptcha-response.recaptcha' => 'Проверка "Я не робот" не пройдена'
        ]);

        // Создание нового пользователя
        $user = new User;
        $user->login = $validatedData['login'];
        $user->password = bcrypt($validatedData['password']);
        $user->secret_word = $validatedData['secret-word'];
        $user->save();
        return redirect('login');
    }
}
