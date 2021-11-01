<div 
  x-data="resetErrorValidation"
  {{ $attributes }}
  >

  <label class="font-bold text-gray-500 block">
    {{ $label }}
    @if($isRequired) <span class="text-red-500">*</span> @endif
  </label>

  <input 
    class="simple-input-1 {{ $inputClass }} @error($name) error @enderror"
    type="{{ $type }}" 
    placeholder="{{ $placeholder }}" 
    name="{{ $name }}"
    value="{{ old($name) }}"
    x-ref="input" 
    @@blur="removeErrorMessage()"
  />

  @error($name)
  <div x-ref="errorMessage" class="text-xs text-red-400">{{ $message }}</div>
  @enderror

</div>