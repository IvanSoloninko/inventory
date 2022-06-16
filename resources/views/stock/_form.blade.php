<div class="col-sm-6 mb-3 mt-3 mb-sm-0">
    <label for="name" ><span style="color:red;">*</span>Name Stock</label>
    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Name Stock" name="name" value="{{ old('name') ?? $stock['name'] ?? '' }}">

    @error('name')
        <span class="text-danger">
            {{$message}}
        </span>
    @enderror
</div>

<div class="col-sm-6 mb-3 mt-3 mb-sm-0">
    <label for="address" ><span style="color:red;">*</span>Address</label>
    <input type="text" class="form-control form-control-user @error('address') is-invalid @enderror" id="address" placeholder="Address" name="address" value="{{ old('address') ?? $stock['address'] ?? '' }}">

    @error('address')
    <span class="text-danger">
            {{$message}}
        </span>
    @enderror
</div>
