@extends('layouts.app')

@section('title', 'Stocks')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Stocks</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('stock.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Create
                    </a>
                </div>
            </div>
        </div>

        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Stock</h6>
            </div>
            <div  class="card-body">
                <div  class="table-responsive">
                    <table id="stockTable" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Create</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($stocks as $stock)
                            <tr>
                                <th scope="row">{{ $stock['id'] }}</th>
                                <td>{{ $stock['name'] }}</td>
                                <td>{{ $stock['address'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($stock['created_at'])->translatedFormat('d.m.y - H:i') }}</td>

                                <td style="display: flex;">
                                    <a href="{{ route('stock.edit', $stock) }}" class="btn btn-primary m-2">
                                        <i aria-hidden="true" class="fa fa-pen"></i>
                                    </a>

                                    <a href="{{ route('stock.items', $stock) }}" class="btn btn-primary m-2">
                                        Items
                                    </a>

                                    <a href="{{ route('stock.export', $stock) }}" class="btn btn-primary m-2">
                                        Excel-File
                                    </a>
                                </td>
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
