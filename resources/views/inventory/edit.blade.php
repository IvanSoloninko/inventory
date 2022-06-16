@extends('layouts.app')

@section('title', 'Add Users')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Inventory</h1>
            <a href="{{route('users.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Inventory</h6>
            </div>
            <form method="POST" action="{{route('inventory.change', $inventory->id)}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">


                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Name Inventory
                            <input
                                type="text"
                                class="form-control form-control-user @error('name_inventory') is-invalid @enderror"
                                id="exampleLastName"
                                placeholder="Name Inventory"
                                name="name_inventory"
                                value="{{ $inventory->name_inventory }}">

                            @error('name_inventory')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Count
                            <input
                                type="text"
                                class="form-control form-control-user @error('count') is-invalid @enderror"
                                id="exampleLastName"
                                placeholder="Count"
                                name="count"
                                value="{{ old('count') ?? $inventory['count'] }}">

                            @error('count')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Description
                            <input
                                type="text"
                                class="form-control form-control-user @error('description') is-invalid @enderror"
                                id="exampleEmail"
                                placeholder="Description"
                                name="description"
                                value="{{ $inventory->description }}">

                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- Mobile Number --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Stock

                            <select name="stock_id" class="form-control @error('stock') is-invalid @enderror">
                                @foreach($stocks as $stock)
                                    <option value="{{ $stock['id'] }}" @if ($inventory['stock_id'] == $stock['id']) selected @endif>
                                        {{ $stock['name'] }}
                                    </option>
                                @endforeach
                            </select>

                            @error('stock')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Condition
                            <input
                                type="text"
                                class="form-control form-control-user @error('condition') is-invalid @enderror"
                                id="exampleMobile"
                                placeholder="Condition"
                                name="condition"
                                value="{{ $inventory->condition }}">

                            @error('condition')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('inventory.list') }}">Cancel</a>
                </div>
            </form>
        </div>

    </div>


@endsection
