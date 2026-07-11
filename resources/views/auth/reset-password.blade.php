<x-layouts.guest>
    <div class="mb-8 text-center">
        <!-- Logo / Title -->
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-200 mb-4 rotate-3">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m-5 8a2 2 0 01-2-2m2 2a15 15 0 011-7m-1 7a15 15 0 001-7M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Reset Password</h1>
        <p class="text-slate-500 mt-1">Please enter your new password below.</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-6">
            <x-ui.alert type="error">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-ui.alert>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email Address -->
        <x-ui.input 
            label="Email Address" 
            name="email" 
            type="email" 
            placeholder="name@company.com" 
            :value="old('email', $email)" 
            required 
            autofocus 
            :error="$errors->first('email')"
        />

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                New Password <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
                <input 
                    :type="show ? 'text' : 'password'" 
                    name="password" 
                    id="password"
                    placeholder="••••••••"
                    required 
                    autocomplete="new-password"
                    class="block w-full px-4 py-2.5 bg-white border {{ $errors->has('password') ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-200 focus:ring-indigo-500' }} rounded-xl text-slate-900 text-sm placeholder-slate-400 transition-all focus:ring-1 outline-none pr-12"
                >
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-600 transition-colors">
                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.888 9.888L14.47 5.29m-2.47 13.535l-4.47-4.47m0 0l-2.235-2.235m15.53 4.47l-2.235-2.235" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1.5 text-sm text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div x-data="{ show: false }">
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">
                Confirm New Password <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
                <input 
                    :type="show ? 'text' : 'password'" 
                    name="password_confirmation" 
                    id="password_confirmation"
                    placeholder="••••••••"
                    required 
                    autocomplete="new-password"
                    class="block w-full px-4 py-2.5 bg-white border border-slate-200 focus:ring-indigo-500 rounded-xl text-slate-900 text-sm placeholder-slate-400 transition-all focus:ring-1 outline-none pr-12"
                >
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-600 transition-colors">
                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.888 9.888L14.47 5.29m-2.47 13.535l-4.47-4.47m0 0l-2.235-2.235m15.53 4.47l-2.235-2.235" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-ui.button full-width size="lg">
                Reset Password
            </x-ui.button>
        </div>
    </form>
</x-layouts.guest>
