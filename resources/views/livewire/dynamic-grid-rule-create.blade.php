<?php
use App\Models\Package\Rule;
?>
<div>
 <!-- Alert Message -->
 @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <button wire:click="createVariant()" class="btn btn-info rounded-0" style="float:left">Back</button>
            <div style="float:right">
                <a style="color:white">Variant</a>&nbsp; > Rule > {{ $rule['title'] }}   
            </div>
        </div>
    </div>
    <form>
        <div class="row" style="display:flex;margin-top: 20px;">
            <hr>
           <?php // <livewire:CountdownTimer :targetTime="'2025-10-26 16:09:00'" /> ?>
            <div class="col-md-12">
                <div class="row" style="display:flex">

                    <div class="col-md-3 mb-3">
                        <?php $MetaKey = 'ddl_event'; $MetaValue['label'] = 'Event';?>
                        <label for="{{ $MetaKey }}" class="form-label pull-left">{{ $MetaValue['label'] }}</label>
                        <select  wire:model="ruleFrom.ddl_event" class="form-select rounded-0" autocomplete="off" id="{{ $MetaKey }}" name="{{ $MetaKey }}"
                            placeholder="" required="">
                            @foreach($rule['ddl_rules_events'] as  $ruleEvent)
                            @if($loop->first)
                            <option value="">--Select Events--</option>
                            @endif
                            <option value="{{ $ruleEvent }}">{{ $ruleEvent }}</option>
                            @endforeach
                        </select>

                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <?php $MetaKey = 'ddl_apply_4'; $MetaValue['label'] = 'Apply For';?>
                        <label for="{{ $MetaKey }}" class="form-label pull-left">{{ $MetaValue['label'] }}</label>
                        <select wire:model="ruleFrom.ddl_apply4" class="form-select rounded-0" autocomplete="off" id="{{ $MetaKey }}" name="{{ $MetaKey }}"
                            placeholder="" required="">
                            @foreach($rule['ddl_rules_apply_4'] as  $apply_4)
                            @if($loop->first)
                            <option value="">--Select Apply--</option>
                            @endif
                            <option value="{{$apply_4}}">{{$apply_4}}</option>
                            @endforeach
                        </select>

                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3" style="text-align:left">
                        <?php $MetaKey = 'ddl_rule'; $MetaValue['label'] = 'Rule';?>
                        <label for="{{ $MetaKey }}" class="form-label pull-left">{{ $MetaValue['label'] }}</label>
                        <select  wire:model="ruleFrom.ddl_rule" wire:change="onChangeRule($event.target.value)"  class="form-select rounded-0" autocomplete="off" id="{{ $MetaKey }}" name="{{ $MetaKey }}"
                            placeholder="" required="">
                        
                           @foreach($rule['ddl_rules'] as $key => $value)
                           @if($loop->first)
                            <option value="">--Select Rules--</option>
                            @endif
                           <option value="{{$value['id']}}">{{$value['name']}}</option>
                           @endforeach
                     <?php //  <option value="{{$key}}">{{$value[$key]['name']}}</option>-- ?>

                        </select>
                        <textarea rows="5" class="form-control" disabled>{{$rule_desc}}</textarea>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div class="col-md-2 mb-3" style="text-align:left">
                        <a wire:click="onClickSaveRule()"   class="btn btn-info rounded-0 mt-5">ADD</a>
                    </div>

                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover table-dark ">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Event</th>
                                    <th width="10%">Apply4</th>
                                    <th width="30%">Rule</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rulesData as $key => $value)
                               
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$value['events']}}</td>
                                    <td>{{$value['apply4']}}</td> 

                                    <?php 
                                        $ObjRule = new App\Models\Package\Rule;
                                        $list = $ObjRule->where('id',$value['rule_id'])->first();
                                        //print_r('<pre>');
                                        //print_r($value['rule_id']);
                                    ?>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        <button wire:click="onDeleteRule({{$value['id']}})" data-id="{{$value['id']}}" class="btn btn-info rounded-0">Delete</button>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <hr>
        </div>
    </form>
    <script>
    // Listen for the event emitted from Livewire
    window.addEventListener('swal:alert', event => {
        Swal.fire({
            icon: event.detail.icon,
            title: 'sucess',
            text: 'hello',
        });
    });
    </script>
</div>