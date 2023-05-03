@foreach ($toko as $item)
<thead>
    <tr>
        <th>{{$item->user->name}}</th>
    </tr>
</thead>
@endforeach
