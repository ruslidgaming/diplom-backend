<div class="input__wrapper {{ isset($class) ? $class : '' }}">
    @isset($label)
        <label class="input__title">{{ $label }}
            @isset($required)
                <span style="color: red">*</span>
            @endisset
        </label>
    @endisset

    <div class="input__input">
        <input type="{{ $type ?? 'text' }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
            value="{{ old($name, isset($value) ? $value : '') }}">
    </div>
</div>
@error($name)
    <p style='color: red'>{{ $message }}</p>
@enderror
