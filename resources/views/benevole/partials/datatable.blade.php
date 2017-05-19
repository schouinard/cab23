@forelse($items as $item)
    <tr>
        <td>{{ $item->category->nom }}</td>
        <td>{{ $item->nom }}</td>
        <td>{{ $type }}</td>
        <td>{{ $item->pivot->priority }}</td>
    </tr>
@empty
    <div class="readonly">Aucun intérêt ou compétence sélectionné.</div>
@endforelse