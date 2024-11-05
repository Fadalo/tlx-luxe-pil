<div>
    <form action="{{ route('admin.member.upload')}}" class="dropzone">
         @csrf
        <div class="fallback">
            <input name="file" type="file" multiple="multiple">
        </div>
        <div class="dz-message needsclick">
            <div class="mb-3">
                <i class="display-4 text-muted ri-upload-cloud-2-line"></i>
            </div>

            <h4>Drop files here or click to upload.</h4>
        </div>
    </form>
</div>

<div class="text-center mt-4">
    <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">
</div>