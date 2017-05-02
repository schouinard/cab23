@component("users.activities.activity", ['record' => $record])

    @slot('icon')
        <i class="fa fa-user bg-blue"></i>
    @endslot
    @slot('heading')
        {{ $profileUser->name }} a créé un service rendu à <a
                href="{{$record->subject->beneficiaire->path()}}">{{ $record->subject->beneficiaire->nom_complet }}</a>.
    @endslot
@endcomponent