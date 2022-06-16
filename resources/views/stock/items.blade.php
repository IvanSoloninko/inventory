@extends('layouts.app')

@section('title', 'Stocks - items')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Stock: {{ $stock['name'] }}</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All items for stock</h6>
            </div>
            <div  class="card-body">
                <div  class="table-responsive">
                    <table id="stockTable" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Inventory name</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Count</th>
                            <th scope="col">Сondition</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <th scope="row">{{ $item->user['full_name'] }}</th>
                                <td>{{ $item->name_inventory }}</td>
                                <td>{{ $stock['name'] }}</td>
                                <td>{{ $item['count'] }}</td>
                                <td>{{ $item->condition }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d.m.y - H:i') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready( function () {
            $('#stockTable').DataTable();
        } );
    </script>
@endsection
