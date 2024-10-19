<div class="btn-group me-1 mt-2">
    <button class="btn btn-info rounded-0 btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        Action <i class="mdi mdi-chevron-down"></i>
    </button>
    <div class="dropdown-menu rounded-0" style="">
        <a class="dropdown-item"
            href="{{ route('admin.'.strtolower($route).'.detail', $module_data['id']) }}">Detail
        </a>
        <a class="dropdown-item"
            href="{{ route('admin.'.strtolower($route).'.edit', $module_data['id']) }}">Edit</a>
        <div class="dropdown-divider"></div>
        <form name="formDelete_{{ $route }}">
        <a class="dropdown-item" name="btnDelete" data-id="{{$module_data['id']}}"
           >Delete</a>
        </form>
    </div>
</div>

