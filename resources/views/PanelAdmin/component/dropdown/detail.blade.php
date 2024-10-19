<div class="mb-3">
    <label  class="form-label">{{ $MetaValue['label'] }}</label>
    <input type="text" class="form-control" id="ddl_{{ $MetaValue['type'].'_'.$MetaKey }}" name="{{ $MetaKey }}" placeholder="exp-test@gmail.com" disabled value="{{ ucfirst($objValue[$MetaKey]) }}"
        required="">
</div>