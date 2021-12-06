<div x-data="resetErrorValidation" class="{{ $class }}">

    <label class="{{ $labelClass }}">{{ $label }}</label>

    <input 
        class="{{ $inputClass }} @error($name){{ $errorClass }} @enderror"
        name="{{ $name }}"
        value="{{ old($name) ?? $value }}"
        x-ref="input"
        @@blur="removeErrorMessage()"
        {{ $attributes }}
    />

      @error($name)
      <div x-ref="errorMessage" class="text-xs text-red-400">{{ $message }}</div>
      @enderror

</div>