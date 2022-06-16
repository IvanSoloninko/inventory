@extends('layouts.app')

@section('title', 'Trade item')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trade item</h1>
            <a href="{{route('inventory.list')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Trade item</h6>
            </div>
            <form method="POST" action="{{ route('inventory.trade', $item) }}">
                @csrf

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Item
                            <input type="text" class="form-control form-control-user" value="{{ $item['name_inventory'] }}" disabled>

                            @error('name_inventory')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>User

                            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                @foreach($users as $user)
                                    <option value="{{ $user['id'] }}">
                                        {{ $user['full_name'] }}
                                    </option>
                                @endforeach
                            </select>

                            @error('user_id')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">Trade</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('inventory.list') }}">Cancel</a>
                </div>
            </form>
        </div>

    </div>


@endsection
