<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Create</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $stock['name'] }}</td>
            <td>{{ $stock['address'] }}</td>
            <td>{{ \Carbon\Carbon::parse($stock['created_at'])->translatedFormat('d.m.y - H:i') }}</td>
        </tr>

        @foreach($stock->iventory as $item)
            <tr>
                <td></td>
                <td>{{ $item->user['full_name'] }}</td>
                <td>{{ $item['name_inventory'] }}</td>
                <td>{{ $item['count'] }}</td>
                <td>{{ $item['condition'] }}</td>
                <td>{{ $item['description'] }}</td>
                <td>{{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d.m.y - H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
