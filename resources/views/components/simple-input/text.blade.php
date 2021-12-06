<div 
  x-data="resetErrorValidation"
  {{ $attributes }}
  >

  <label class="font-bold text-gray-500 block">
    {{ $label }}
    @if($required) <span class="text-red-500">*</span> @endif
  </label>

  <input 
    class="simple-input-1 {{ $inputClass }} @error($name) error @enderror"
    type="{{ $type }}" 
    placeholder="{{ $placeholder }}" 
    name="{{ $name }}"
    value="{{ old($name) ?? $value }}"
    x-ref="input" 
    @@blur="removeErrorMessage()"
    :disabled="@json($disabled)"
    :required="@json($required)"
  />

  @error($name)
  <div x-ref="errorMessage" class="text-xs text-red-400">{{ $message }}</div>
  @enderror

</div>