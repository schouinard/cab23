<h6 class="row">
    <span class="col-xs-5">Service</span>
    @foreach($serviceRequestStatuses as $requestStatus)
        <span class="col-xs-1">
                {{$requestStatus->nom}}
            </span>
    @endforeach
</h6>
@foreach($serviceTypes as $serviceType)

    <div class="row">
        <fieldset>

            <div class="col-xs-5">
                {{$serviceType->nom}}
            </div>

            @foreach($serviceRequestStatuses as $requestStatus)
                <div class="col-xs-1">
                    {{Form::radio('requests[' . $serviceType->id . '][service_request_status_id]', $requestStatus->id, $requestStatus->id == 1)}}
                </div>
            @endforeach
        </fieldset>

    </div>

@endforeach