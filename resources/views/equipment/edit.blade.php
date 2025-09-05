@extends('layouts.app')

@section('content')
<h1>編集画面</h1>

<form action="{{ route('equipment.update', $equipment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>名前</label>
        <input type="text" name="name" value="{{ old('name', $equipment->name) }}">
        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>タイプ</label>
        <input type="text" name="type" value="{{ old('type', $equipment->type) }}">
        @error('type')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">更新</button>
</form>
@endsection