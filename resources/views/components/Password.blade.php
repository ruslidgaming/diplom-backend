<div class="input__wrapper {{ isset($class) ? $class : '' }}">
    @isset($label)
        <label class="input__title">{{ $label }}
            @isset($required)
                <span style="color: red">*</span>
            @endisset
        </label>
    @endisset

    <div class="input__input">
        <input type="password" name="{{ $name }}" placeholder="{{ $placeholder }}">
        <div class="input-password__icon" onclick="togglePassword(this)">
            <img class="icon" src="{{ asset('img/icons/eye.svg') }}" alt="">
        </div>
    </div>
</div>
@error($name)
    <p style='color: "red"'>{{ $message }}</p>
@enderror
