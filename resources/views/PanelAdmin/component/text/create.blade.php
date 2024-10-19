<div class="mb-3">
    <label for="{{ $MetaKey }}" class="form-label">{{ $MetaValue['label'] }}</label>
    <input type="text" class="form-control"  autocomplete="off" id="{{ $MetaKey }}" name="{{ $MetaKey }}" placeholder=""  
        required="">
    <div class="valid-feedback">
        Looks good!
    </div>
</div>