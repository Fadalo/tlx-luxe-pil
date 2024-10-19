<div class="mb-3">
    <label for="validationCustom01" class="form-label">{{ $MetaValue['label'] }}</label>
    <input type="text" class="form-control"  placeholder="" disabled value="{{ date('F, d/Y',strtotime($objValue[$MetaKey])) }}"
        required="">
    <div class="valid-feedback">
        Looks good!
    </div>
</div>