@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-base-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">編集画面</h1>

    <form action="{{ route('equipment.update', $equipment->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="form-control w-full">
            <label class="label" for="name">
                <span class="label-text">Name</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $equipment->name) }}" class="input input-bordered w-full">
            @error('name')
                <span class="text-error text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control w-full">
            <label class="label" for="brand">
                <span class="label-text">Brand</span>
            </label>
            <input type="text" id="brand" name="brand" value="{{ old('brand', $equipment->brand) }}" class="input input-bordered w-full">
            @error('brand')
                <span class="text-error text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control w-full">
            <label class="label" for="category">
                <span class="label-text">Category</span>
            </label>
            <input type="text" id="category" name="category" value="{{ old('category', $equipment->category) }}" class="input input-bordered w-full">
            @error('category')
                <span class="text-error text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control w-full">
            <label class="label" for="purchased_at">
                <span class="label-text">Purchased At</span>
            </label>
            <input type="date" id="purchased_at" name="purchased_at" value="{{ old('purchased_at', $equipment->purchased_at) }}" class="input input-bordered w-full">
        </div>

        <div class="form-control w-full">
            <label class="label" for="price">
                <span class="label-text">Price</span>
            </label>
            <input type="number" id="price" name="price" value="{{ old('price', $equipment->price) }}" class="input input-bordered w-full">
        </div>

        <div class="form-control w-full">
            <label class="label" for="status">
                <span class="label-text">Status</span>
            </label>
            <input type="text" id="status" name="status" value="{{ old('status', $equipment->status) }}" class="input input-bordered w-full">
        </div>

        <div class="form-control w-full">
            <label class="label" for="notes">
                <span class="label-text">Notes</span>
            </label>
            <textarea id="notes" name="notes" class="textarea textarea-bordered w-full">{{ old('notes', $equipment->notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-4 w-full">更新</button>
    </form>
</div>
@endsection
