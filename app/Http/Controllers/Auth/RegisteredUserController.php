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
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'username' => ['required', 'string', 'min:6', 'max:255', 'unique:' . User::class, 'lowercase', 'regex:/^[а-яё0-9]+$/u'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'full_name' => ['required', 'string', 'max:255', 'regex:/^[а-яА-ЯёЁ\s]+$/u'],
                'phone_number' => ['required', 'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            ],
            [
                'username.regex' => 'Имя должно содержать только строчные кириллические буквы и цифры.',
                'full_name.regex' => 'ФИО должно содержать только кириллические буквы и пробелы.',
                'phone_number.regex' => 'Телефон должен быть в формате +7(XXX)XXX-XX-XX',
            ],
        );

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
