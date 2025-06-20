@extends('layouts.app')

@section('content')
<h1 class="text-3xl аш">Регистрация</h1>
<div class="container sm:max-w-md mt-6 px-6 py-4 bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Логин -->
        <div>
            <x-input-label for="username" value="Логин" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Пароль -->
        <div class="mt-4">
            <x-input-label for="password" value="Пароль" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Подтвердите пароль -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Подтвердите пароль" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- ФИО -->
        <div class="mt-4">
            <x-input-label for="full_name" value="ФИО" />
            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name"
                :value="old('full_name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
        </div>

        <!-- Телефон -->
        <div class="mt-4">
            <x-input-label for="phone_number" value="Телефон" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number"
                :value="old('phone_number')" required autocomplete="tel" pattern="^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$"
                placeholder="+7(XXX)XXX-XX-XX" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                Уже зарегистрированы?
            </a>

            <x-primary-button class="ms-4">
                Регистрация
            </x-primary-button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/inputmask.min.js"
    integrity="sha512-eD+19OyeG3GbJ6QGk9uI7TfTozYXAVPz6/Va/YVVuBz7ZFvAeiFzol0whJplf9l6cNQcA8sVxVXvCFW489cAVA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    Inputmask("+7(999)999-99-99").mask(document.getElementById('phone_number'));
</script>
@endpush