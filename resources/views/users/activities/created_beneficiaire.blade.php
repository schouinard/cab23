@component("users.activities.activity", ['record' => $record])

    @slot('icon')
        <i class="fa fa-user bg-blue"></i>
    @endslot
    @slot('heading')
        {{ $profileUser->name }} a créé le bénéficiaire <a
                href="{{$record->subject->path()}}">{{ $record->subject->nom_complet }}</a>.
    @endslot
@endcomponent