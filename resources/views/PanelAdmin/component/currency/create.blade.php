<div class="mb-3">
    <label for="{{ $MetaKey }}" class="form-label">{{ $MetaValue['label'] }}</label>
    
    <input id="input-currency" name="{{ $MetaKey }}"  class="form-control input-mask text-left" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'Rp ', 'placeholder': '0'" inputmode="numeric" style="text-align: right;">
    <div class="valid-feedback">
        Looks good!
    </div>
</div>