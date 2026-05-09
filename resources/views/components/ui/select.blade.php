@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'selected' => null,
    'error' => null,
    'required' => false,
    'placeholder' => 'Select an option',
])

<div class="w-full">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-slate-700 mb-1.5">
            {{ $label }}
            @if($required)
                <span class="text-rose-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <select 
            name="{{ $name }}" 
            id="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'appearance-none block w-full px-4 py-2.5 bg-white border ' . ($error ? 'border-rose-500 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 focus:ring-indigo-500 focus:border-indigo-500') . ' rounded-xl text-slate-900 text-sm transition-all focus:ring-1 outline-none']) }}
        >
            @if($placeholder)
                <option value="" disabled {{ is_null(old($name, $selected)) ? 'selected' : '' }}>{{ $placeholder }}</option>
            @endif

            @foreach($options as $value => $labelOption)
                <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                    {{ $labelOption }}
                </option>
            @endforeach
        </select>
        
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>

    @if($error)
        <p class="mt-1.5 text-sm text-rose-600 font-medium">{{ $error }}</p>
    @endif
</div>
