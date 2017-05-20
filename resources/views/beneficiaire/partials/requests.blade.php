@if(isset($readonly))
    <h3 class="col-md-12">Services demandés</h3>
    <div class="col-md-12">
        <ul>
            @foreach($beneficiaire->serviceRequests as $serviceRequest)
                <li>{{$serviceRequest->nom}}
                    <strong>({{$serviceRequestStatuses->where('id', $serviceRequest->pivot->service_request_status_id)->first()->nom}}
                        )</strong></li>
            @endforeach
        </ul>
    </div>
    <h3 class="col-md-12">Services reçus</h3>
    <div class="col-md-12">
        <table class="table table-bordered table-hover services-donne" width="100%">
            <thead>
            <tr>
                <td>Type</td>
                <td>Bénévole</td>
                <td>Rendu le</td>
                <td>Don</td>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total:</th>
                <th></th>
            </tr>
            </tfoot>
            <tbody>
            @foreach ($beneficiaire->services as $service)
                <tr>
                    <td>
                        {{ $service->type->nom }}
                    </td>
                    <td>
                        <a href="{{ $service->benevole->path() }}">{{ $service->benevole->nom }}
                            , {{ $service->benevole->prenom }}</a>
                    </td>
                    <td>
                        {{ $service->rendu_le }}
                    </td>
                    <td>
                        {{ $service->don }}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@else
    <h6 class="col-md-12">
        <span class="col-xs-5">Service</span>
        @foreach($serviceRequestStatuses as $requestStatus)
            <span class="col-xs-1">
                {{$requestStatus->nom}}
            </span>
        @endforeach
    </h6>
    <fieldset class="col-md-12 striped">

        @foreach($serviceTypes as $serviceType)

            <div class="col-md-12">

                <div class="col-xs-5">
                    {{$serviceType->nom}}
                </div>

                @foreach($serviceRequestStatuses as $requestStatus)
                    <div class="col-xs-1">
                        {{Form::radio('serviceRequests[' . $serviceType->id . '][service_request_status_id]', $requestStatus->id, isset($beneficiaire) ? $beneficiaire->isServiceRequested($serviceType->id, $requestStatus->id) : $requestStatus->id == 1)}}
                    </div>
                @endforeach
            </div>
        @endforeach
    </fieldset>

@endif