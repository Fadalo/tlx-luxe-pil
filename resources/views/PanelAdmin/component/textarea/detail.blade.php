<div class="mb-3">
    <label for="{{ $MetaKey }}" class="form-label">{{ $MetaValue['label'] }}</label>
    
    <textarea  class="form-control" id="{{ $MetaKey }}"
    name="{{ $MetaKey }}" rows="3" required disabled>{{ $objValue[$MetaKey] }}</textarea>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>