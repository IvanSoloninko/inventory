@extends('layouts.app')

@section('title', 'History')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">History</h1>
        </div>

        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($history as $item)
                <tr>
                    <th scope="row">{{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d.m.y - H:i') }}</th>
                    <td>{{ $item['text'] }}</td>
                </tr>
            @empty
                <tr>
                    <th colspan="2" class="table-danger">No history...</th>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection

