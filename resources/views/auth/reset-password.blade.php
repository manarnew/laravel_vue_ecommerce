<x-app-layout>
    <div class="w-[400px] mx-auto my-16">
        <h2 class="text-2xl font-semibold text-center mb-5">
            Enter your new password
        </h2>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-text-input id="email" placeholder="Your Email" class="block mt-1 w-full" type="email"
                    name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />

            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-text-input placeholder="Password" id="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="new-password" />

            </div>

            <!-- Confirm Password -->
            <div class="mt-4">

                <x-text-input placeholder="Repeat Password" id="password_confirmation" class="block mt-1 w-full"
                    type="password" name="password_confirmation" required autocomplete="new-password" />


            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
