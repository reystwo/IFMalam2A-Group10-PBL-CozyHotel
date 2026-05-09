<x-layouts.guest>
    <div class="mb-8 text-center">
        <!-- Logo / Title -->
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-200 mb-4 rotate-3">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">CozyHotel</h1>
        <p class="text-slate-500 mt-1">Welcome back! Please sign in to your account.</p>
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

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <x-ui.input 
            label="Email Address" 
            name="email" 
            type="email" 
            placeholder="name@company.com" 
            :value="old('email')" 
            required 
            autofocus 
            :error="$errors->first('email')"
        />

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-semibold text-slate-700">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <x-ui.input 
                name="password" 
                type="password" 
                placeholder="••••••••" 
                required 
                autocomplete="current-password"
                :error="$errors->first('password')"
            />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 text-indigo-600 bg-white border-slate-300 rounded-md focus:ring-indigo-500 focus:ring-2 transition-all cursor-pointer">
            <label for="remember_me" class="ml-2 block text-sm text-slate-600 cursor-pointer select-none">
                Remember me for 30 days
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-ui.button full-width size="lg">
                Sign In to Dashboard
            </x-ui.button>
        </div>
    </form>

    <!-- Optional: Register Link (if needed) -->
    @if (Route::has('register'))
        <p class="mt-8 text-center text-sm text-slate-500">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                Sign Up Account
            </a>
        </p>
    @endif
</x-layouts.guest>
