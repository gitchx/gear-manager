@extends('layouts.app')

@section('content')
<h1>編集画面</h1>

<form action="{{ route('equipment.update', $equipment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $equipment->name) }}">
        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $equipment->brand) }}">
        @error('brand')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="purchased_at">Purchased At</label>
        <input type="date" class="form-control" id="purchased_at" name="purchased_at" value="{{ old('purchased_at', $equipment->purchased_at) }}">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $equipment->price) }}">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $equipment->status) }}">
    </div>
    <div class="form-group">
        <label for="notes">Notes</label>
        <textarea class="form-control" id="notes" name="notes">{{ old('notes', $equipment->notes) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">更新</button>
</form>
@endsection