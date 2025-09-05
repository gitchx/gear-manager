@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">機材一覧</h1>

    <div class="mb-4">
        <button class="btn btn-primary" onclick="location.href='{{ route('equipment.create') }}'">
            新規作成
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メーカー</th>
                    <th>購入日</th>
                    <th>価格</th>
                    <th>状態</th>
                    <th>メモ</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
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
                        <a class="btn btn-sm btn-secondary" href="{{ route('equipment.edit', $item->id) }}">
                            編集
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
