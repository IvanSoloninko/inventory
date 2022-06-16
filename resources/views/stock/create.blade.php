@extends('layouts.app')

@section('title', 'Add Stock')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create stock</h1>
            <a href="{{route('stock.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>

        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create stock</h6>
            </div>
            <form method="POST" action="{{route('stock.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        @include('stock._form')
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('stock.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
