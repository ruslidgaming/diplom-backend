<div class="input__wrapper {{ isset($class) ? $class : '' }}">
    @isset($label)
        <label class="input__title">{{ $label }}
            @isset($required)
                <span style="color: red">*</span>
            @endisset
        </label>
    @endisset

    <div class="input__input">
        <textarea name="{{ $name }}" placeholder="{{ $placeholder }}">
            {{ old($name, isset($value) ? $value : '') }}
        </textarea>
    </div>
</div>
@error($name)
    <p style='color: "red"'>{{ $message }}</p>
@enderror
