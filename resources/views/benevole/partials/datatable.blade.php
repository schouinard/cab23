@foreach($items as $item)
    <tr>
        <td>{{ $item->category->nom }}</td>
        <td>{{ $item->nom }}</td>
        <td>{{ $item->type == 'interet' ? 'Intérêt' : 'Compétence' }}</td>
        <td>{{ $item->pivot->priority }}</td>
    </tr>
@endforeach