@extends('layouts.app')

@section('content')
<div class="container">
    <h1>機材をリストに追加</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipment.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}" required>
        </div>
        <div class="form-group">
            <label for="purchased_at">Purchased At</label>
            <input type="date" class="form-control" id="purchased_at" name="purchased_at" value="{{ old('purchased_at') }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}">
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes">{{ old('notes') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Equipment</button>
    </form>
</div>
@endsection