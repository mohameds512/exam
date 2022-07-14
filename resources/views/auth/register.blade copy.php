
<x-guest-layout >
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form  method="POST" action="{{ route('register') }}" style="text-align: right">
            @csrf

            <!-- Name -->
            <div>
                <label for="name"> {{ trans('main_trans.name') }} </label>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- phoneNumber -->
            <div class="mt-4">
                <label for="name"> {{ trans('main_trans.phoneNum') }} </label>

                <x-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber" :value="old('phoneNumber')" required autofocus />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <label for="name"> {{ trans('main_trans.email') }} </label>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="name"> {{ trans('main_trans.Password') }} </label>

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="new-password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="name"> {{ trans('main_trans.Confirm_Password') }} </label>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- Register as -->

            <div class="mt-4">
                <div class="row">
                    <span style="margin-left: 15px">
                        <label for="teacher"> {{ trans('register_trans.teacher') }} </label>
                        <input class="form-control" type="radio" name="role" id="teacher" value="3">
                    </span> <br>
                    <span style="margin-left: 15px">
                        <label for="student"> {{ trans('register_trans.student') }} </label>
                        <input class="form-control" type="radio" name="role" id="student" value="4">
                    </span>

                </div>

            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ trans('register_trans.already_registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ trans('register_trans.register') }}
                </x-button>

                <a class="btn btn-sm  btn-info" href = "{{ url('redirectSocial/facebook') }}">
                    {{ trans('register_trans.FB_register') }}
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
