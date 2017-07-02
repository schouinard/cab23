<div class="col-md-12">
    <fieldset @if(isset($readonly)) disabled @endif>
        <legend>Clientèles</legend>
        @foreach($clienteles as $clientele)
            <div class="checkbox col-md-4" @if($loop->first) style="margin-top: -5px;" @endif >
                <label>{{ Form::checkbox('clienteles[]', $clientele->id, isset($benevole) ? in_array($clientele->id, $benevole->selectedClienteles) : null) }}{{$clientele->nom}}</label>
            </div>
        @endforeach
    </fieldset>
</div>

@if(isset($readonly) && isset($benevole))
    <div class="col-md-12">
        <h3>Intérêts et compétences</h3>
        <table class="datatable table table-bordered table-hover">
            <thead>
            <tr>
                <th>Catégorie</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Intérêt / Force</th>
            </tr>
            </thead>
            <tbody>
            @include('benevole.partials.datatable', ['items' => $benevole->competences])
            </tbody>
        </table>
    </div>
@else
    <div id="accordion">
        @foreach($interestGroups as $category)
            <h3 class="col-md-12">
                <a data-toggle="collapse" data-parent="#accordion" href="#{{$category->id}}" aria-expanded="false"
                   class="collapsed">
                    {{ $category->nom }}
                </a>
            </h3>
            <div id="{{$category->id}}" class="panel-collapse collapse" aria-expanded="false">
                <fieldset class="col-md-12 striped">
                    <legend class="col-xs-8" style="padding-left:30px;">Intérêts</legend>
                    <div class="small col-xs-1">Pas intéressé</div>
                    <div class="small col-xs-1">Peu intéressé</div>
                    <div class="small col-xs-1">Intéressé</div>
                    <div class="small col-xs-1">Très intéressé</div>
                    @forelse($interests->where('category_id', $category->id) as $interet)
                        <div class="col-xs-12">
                            <div class="col-xs-8" style="padding-left:45px;">{{ $interet->nom }}</div>
                            <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][interets][' . $interet->id . '][priority]', 0, true)}}</div>
                            <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][interets][' . $interet->id . '][priority]', 3, isset($benevole) ? $benevole->isInterested($interet->id, 3) : null)}}</div>
                            <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][interets][' . $interet->id . '][priority]', 2, isset($benevole) ? $benevole->isInterested($interet->id, 2) : null)}}</div>
                            <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][interets][' . $interet->id . '][priority]', 1, isset($benevole) ? $benevole->isInterested($interet->id, 1) : null)}}</div>
                        </div>
                    @empty
                        <div class="col-xs-12">
                            Aucun intérêt dans cette catégorie.
                        </div>
                    @endforelse
                </fieldset>
                <fieldset class="col-md-12 striped">
                    <legend class="col-xs-8" style="padding-left:30px;">Compétences</legend>
                    <div class="small col-xs-1">Aucune</div>
                    <div class="small col-xs-1">Faible</div>
                    <div class="small col-xs-1">Moyenne</div>
                    <div class="small col-xs-1">Forte</div>
                    @forelse($competences->where('category_id', $category->id) as $competence)
                        <div class="col-xs-12">
                            <div class="col-xs-8" style="padding-left:45px;">{{ $competence->nom }}</div>
                            <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][competences][' . $competence->id . '][priority]', 0, true)}}</div>
                            <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][competences][' . $competence->id . '][priority]', 3, isset($benevole) ? $benevole->isCompetent($competence->id, 3) : null)}}</div>
                            <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][competences][' . $competence->id . '][priority]', 2, isset($benevole) ? $benevole->isCompetent($competence->id, 2) : null)}}</div>
                            <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][competences][' . $competence->id . '][priority]', 1, isset($benevole) ? $benevole->isCompetent($competence->id, 1) : null)}}</div>
                        </div>
                    @empty
                        <div class="col-xs-12">
                            Aucune compétence dans cette catégorie.
                        </div>
                    @endforelse
                </fieldset>
            </div>
        @endforeach
    </div>
@endif