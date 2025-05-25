<div className="input__wrapper {{ isset($class) ? $class : '' }}">
    @isset($label)
        <label className="input__title">{{ $label }}
            @isset($required)
                <span style="color: red">*</span>
            @endisset
        </label>
    @endisset

    <div className="input__input">
        <input type="{{ $type ?? 'text' }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
            value="{{ old($name, isset($value) ? $value : '') }}">
    </div>
</div>
@error($name)
    <p style='color: "red"'>{{ $message }}</p>
@enderror
