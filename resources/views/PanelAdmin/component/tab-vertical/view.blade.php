<div class="card">
    <div class="card-body" style="margin:0px;padding:0px">

        <div class="row" style="margin:0px;padding:0px">
            <div class="col-md-2">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    @foreach($data as $key => $value)

                    @if($value['is_actived']== 'true')
                    <a class ="btn btn-primary mb-2 rounded-0" href="javascript:document.getElementById('v-pills-{{ $value['title'] }}-tab').click();">{{$value['title']}}</a>
                    <a class="nav-link mb-2 active" style="display:none" id="v-pills-{{ $value['title'] }}-tab" data-bs-toggle="pill"
                        href="#v-pills-{{ $value['id'] }}" role="tab" aria-controls="v-pills-{{ $value['id'] }}"
                        aria-selected="true">{{$value['title']}}</a>

                    @else
                    <a class ="btn btn-primary mb-2 rounded-0" href="javascript:document.getElementById('v-pills-{{ $value['title'] }}-tab').click();">{{$value['title']}}</a>
                    <a class="nav-link mb-2" style="display:none" id="v-pills-{{ $value['title'] }}-tab" data-bs-toggle="pill"
                        href="#v-pills-{{ $value['id'] }}" role="tab" aria-controls="v-pills-{{ $value['id'] }}"
                        aria-selected="false">{{$value['title']}}</a>

                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-10 mb-4" style="border:1px solid #353d55;min-height:300px">
                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                    @foreach($data as $key => $value)
                    @if($value['is_actived']== 'true')
                    <div class="tab-pane fade active show" id="v-pills-{{ $value['id'] }}" role="tabpanel"
                        aria-labelledby="v-pills-{{ $value['id'] }}-tab">
                        <p>
                        <div class="card">
                            <div>
                                @include($value['render'])

                            </div>
                        </div>
                        </p>
                    </div>
                    @else
                    <div class="tab-pane fade" id="v-pills-{{ $value['id'] }}" role="tabpanel"
                        aria-labelledby="v-pills-{{ $value['id'] }}-tab">
                        <p>
                            @include($value['render'])
                        </p>

                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>