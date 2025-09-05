@extends('layouts.app')

@section('content')
<h1>機材一覧</h1>
<button class="btn btn-primary" onclick="location.href='{{ route('equipment.create') }}'">新規作成</button>
<table border="1">
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>メーカー</th>
        <th>購入日</th>
        <th>価格</th>
        <th>状態</th>
        <th>メモ</th>
    </tr>
    @foreach ($equipment as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->brand }}</td>
        <td>{{ $item->purchased_at }}</td>
        <td>{{ $item->price }}</td>
        <td>{{ $item->status }}</td>
        <td>{{ $item->notes }}</td>
        <td>
            <a href="{{ route('equipment.edit', $item->id) }}">編集</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
