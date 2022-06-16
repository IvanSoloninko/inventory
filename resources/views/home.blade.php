@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>

    @if (Auth::user()->hasRole('Admin'))
        <div class="row">
            <div class="col-md-6">
                <table class="table">
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

                <a href="{{ route('history') }}" class="btn btn-primary">View all</a>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-3">Welcome To  Inventory Dashboard!</h2>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">


</div>
@endsection
