@extends('templates.default')
@section('content')
    <div class="col-6 offset-3">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">

                <x-bootstrap.input-label for="name" :value="__('Name')"/>
                <x-bootstrap.text-input id="name" class="block mt-1 w-full"
                                        type="text"
                                        name="name" :value="old('name')"
                                        required
                                        autofocus
                                        autocomplete="name"/>
                <x-bootstrap.input-error :messages="$errors->get('name')"
                                         class="mt-2"/>
            </div>

            <!-- Email Address -->
            <div class="mb-3">

                <x-bootstrap.input-label for="email" :value="__('Email')"/>
                <x-bootstrap.text-input id="email" class="block mt-1 w-full"
                                        type="email"
                                        name="email" :value="old('email')"
                                        required
                                        autocomplete="username"/>
                <x-bootstrap.input-error :messages="$errors->get('email')"
                                         class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mb-3">

                <x-bootstrap.input-label for="password"
                                         :value="__('Password')"/>

                <x-bootstrap.text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password"/>

                <x-bootstrap.input-error :messages="$errors->get('password')"
                                         class="mt-2"/>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">

                <x-bootstrap.input-label for="password_confirmation"
                                         :value="__('Confirm Password')"/>

                <x-bootstrap.text-input id="password_confirmation"
                                        class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required
                                        autocomplete="new-password"/>

                <x-bootstrap.input-error
                    :messages="$errors->get('password_confirmation')"
                    class="mt-2"/>
            </div>

            <div class="d-flex align-items-center justify-content-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-bootstrap.primary-button class="ms-4">
                    {{ __('Register') }}
                </x-bootstrap.primary-button>
            </div>
        </form>
    </div>
    @extends('templates.default')
    @section('content')
