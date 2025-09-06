@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-base-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">機材をリストに追加</h1>

    @if ($errors->any())
        <div class="alert alert-error mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipment.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="form-control w-full">
            <label class="label" for="name">
                <span class="label-text">Name</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="機材名" class="input input-bordered w-full" required>
        </div>

        <div class="form-control w-full">
            <label class="label" for="brand">
                <span class="label-text">Brand</span>
            </label>
            <input type="text" id="brand" name="brand" value="{{ old('brand') }}" placeholder="メーカー名" class="input input-bordered w-full">
        </div>

        <div class="form-control w-full">
            <label class="label" for="category">
                <span class="label-text">Category</span>
            </label>
            <input type="text" id="category" name="category" value="{{ old('category') }}" placeholder="カテゴリ" class="input input-bordered w-full">
        </div>

        <div class="form-control w-full">
            <label class="label" for="purchased_at">
                <span class="label-text">Purchased At</span>
            </label>
            <input type="date" id="purchased_at" name="purchased_at" value="{{ old('purchased_at') }}" class="input input-bordered w-full">
        </div>

        <div class="form-control w-full">
            <label class="label" for="price">
                <span class="label-text">Price</span>
            </label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="価格" class="input input-bordered w-full">
        </div>

        <div class="form-control w-full">
            <label class="label" for="status">
                <span class="label-text">Status</span>
            </label>
            <input type="text" id="status" name="status" value="{{ old('status') }}" placeholder="状態" class="input input-bordered w-full">
        </div>

        <div class="form-control w-full">
            <label class="label" for="notes">
                <span class="label-text">Notes</span>
            </label>
            <textarea id="notes" name="notes" placeholder="メモ" class="textarea textarea-bordered w-full">{{ old('notes') }}</textarea>
        </div>

        <div class="form-control w-full mt-4">
            <button type="submit" class="btn btn-primary">機材を追加</button>
        </div>
    </form>
</div>
@endsection
