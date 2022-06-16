<table>
    <thead>
    <tr>
        <th>User</th>
        <th>Inventory name</th>
        <th>Count</th>
        <th>Stock</th>
        <th>Condition</th>
        <th>Description</th>
        <th>Create item</th>
        <th>Create</th>
    </tr>
    </thead>
    <tbody>
    @foreach($inventory as $item)
        <tr>
            <td>{{ $item->user['full_name'] }}</td>
            <td>{{ $item['name_inventory'] }}</td>
            <td>{{ $item['count'] }}</td>
            <td>{{ $item->stock['name'] }}</td>
            <td>{{ $item['condition'] }}</td>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item->userCreated['full_name'] }}</td>
            <td>{{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d.m.y - H:i') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
