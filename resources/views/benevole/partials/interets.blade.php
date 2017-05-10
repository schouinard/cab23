<div class="col-md-12">
    <fieldset>
        <legend>Clientèles</legend>
        @foreach($clienteles as $clientele)
            <div class="checkbox col-md-4">
                <label>{{ Form::checkbox('clienteles[]', $clientele->id) }}{{$clientele->nom}}</label>
            </div>
        @endforeach
    </fieldset>
</div>

@foreach($interestGroups as $category)
    <h2 class="col-md-12">{{ $category->nom }}</h2>
    <fieldset class="col-md-12 striped">
        <legend class="col-xs-8">Intérêts</legend>
        <div class="small col-xs-1">Pas intéressé</div>
        <div class="small col-xs-1">Peu intéressé</div>
        <div class="small col-xs-1">Intéressé</div>
        <div class="small col-xs-1">Très intéressé</div>
        @foreach($category->interets as $interet)
            <div class="col-xs-12">
                <div class="col-xs-8">{{ $interet->nom }}</div>
                @for($i = 0; $i < 4; $i++)
                    <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][interets][' . $interet->id . '][priority]', $i, $i == 0)}}</div>
                @endfor
            </div>

        @endforeach
    </fieldset>
    <fieldset class="col-md-12 striped">
        <legend class="col-xs-8">Compétences</legend>
        <div class="small col-xs-1">Pas intéressé</div>
        <div class="small col-xs-1">Peu intéressé</div>
        <div class="small col-xs-1">Intéressé</div>
        <div class="small col-xs-1">Très intéressé</div>
        @foreach($category->competences as $competence)
            <div class="col-xs-12">
                <div class="col-xs-8">{{ $competence->nom }}</div>
                @for($i = 0; $i < 4; $i++)
                    <div class="text-center col-xs-1">{{Form::radio('category['. $category->id . '][competences][' . $competence->id . '][priority]', $i, $i==0)}}</div>
                @endfor
            </div>
        @endforeach
    </fieldset>
@endforeach