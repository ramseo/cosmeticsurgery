    <div class="col-12">
        <div class="form-group">
            @if($service->input_type_value == 'text')
                {{ Form::label('name', Str::title($service->name) ) }}
                {{ Form::text("input_type_value[$service->id]", isset($pricesData[$service->id]['service_type'])? $pricesData[$service->id]['service_type']:null, array('class' => 'form-control')) }}
            @endif
            @if($service->input_type_value == 'number')
                {{ Form::label('name',  Str::title($service->name) ) }}
                {{ Form::number("input_type_value[$service->id]", isset($pricesData[$service->id]['service_type'])? $pricesData[$service->id]['service_type']:null, array('class' => 'form-control')) }}
            @endif
            @if($service->input_type_value == 'price')
                {{ Form::label('name',  Str::title($service->name) ) }}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">₹</span>
                        </div>
                        @php $placeholder = 'Price per Day'; @endphp
                        @if($service->service_on_basis == 'complete')
                            @php $placeholder = 'Price  for '. $service->name  ; @endphp
                        @endif
                        {{ Form::number("input_type_value[$service->id]", isset($pricesData[$service->id]['input_type_value'])? $pricesData[$service->id]['input_type_value']:null, array('class' => 'form-control','placeholder'=>$placeholder)) }}
                    </div>

            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">

            {{ Form::label('description', Str::title($service->name) .' Description (optional)' ) }}
            {{ Form::text("description[$service->id]", isset($pricesData[$service->id]['description'])? $pricesData[$service->id]['description']:null, array('class' => 'form-control')) }}
        </div>
    </div>

