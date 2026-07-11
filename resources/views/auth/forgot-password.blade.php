<x-layouts.guest>
    <div class="mb-8 text-center">
        <!-- Logo / Title -->
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-200 mb-4 rotate-3">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m-5 8a2 2 0 01-2-2m2 2a15 15 0 011-7m-1 7a15 15 0 001-7M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Forgot Password</h1>
        <p class="text-slate-500 mt-1">No problem. Enter your email and we'll send you a password reset link.</p>
    </div>

    <!-- Session Status -->
    @if (session('success'))
        <div class="mb-6">
            <x-ui.alert type="success">
                {{ session('success') }}
            </x-ui.alert>
        </div>
    @endif

    @if (session('status'))
        <div class="mb-6">
            <x-ui.alert type="success">
                {{ session('status') }}
            </x-ui.alert>
        </div>
    @endif

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

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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

        <!-- Submit Button -->
        <div class="pt-2">
            <x-ui.button full-width size="lg">
                Email Password Reset Link
            </x-ui.button>
        </div>
    </form>

    <p class="mt-8 text-center text-sm text-slate-500">
        Remembered your password? 
        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
            Back to Sign In
        </a>
    </p>
</x-layouts.guest>
