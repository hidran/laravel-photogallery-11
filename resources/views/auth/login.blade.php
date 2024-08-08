@extends('templates.default')
@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>
    <div class="col-6 offset-3">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <x-bootstrap.input-label for="email" :value="__('Email')"/>
                <x-bootstrap.text-input id="email" class="block mt-1 w-full"
                                        type="email"
                                        name="email" :value="old('email')"
                                        required
                                        autofocus
                                        autocomplete="username"/>
                <x-bootstrap.input-error :messages="$errors->get('email')"
                                         class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-bootstrap.input-label for="password"
                                         :value="__('Password')"/>

                <x-bootstrap.text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="current-password"/>

                <x-bootstrap.input-error :messages="$errors->get('password')"
                                         class="mt-2"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                           name="remember">
                    <span
                        class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-bootstrap.primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-bootstrap.primary-button>
            </div>
        </form>
    </div>
@endsection
