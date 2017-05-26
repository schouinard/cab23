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
                <th>Type</th>
                <th>Bénévole</th>
                <th>Rendu le</th>
                <th>Don</th>
                <th>Durée</th>
                <th>Note</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($beneficiaire->services as $service)
                <tr>
                    <td>
                        {{ $service->competence->nom }}
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
                    <td>{{$service->heures}}</td>
                    <td>
                        @if($service->note)
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                    data-target="#myModal{{$service->id}}">
                                Note
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal{{$service->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Note</h4>
                                        </div>
                                        <div class="modal-body">
                                            {!! $service->note !!}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total:</th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
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