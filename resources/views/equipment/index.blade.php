@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">

    <h1 class="text-2xl font-bold mb-4">機材一覧</h1>

    {{-- 新規作成ボタン --}}
    <div class="mb-4">
        <button class="btn btn-primary" onclick="location.href='{{ route('equipment.create') }}'">
            新規作成
        </button>
    </div>

    {{-- アラート用コンテナ --}}
    <div id="alert-container" class="fixed top-4 right-4 z-50"></div>

    {{-- 機材テーブル --}}
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full text-sm sm:text-base">

            <thead>
                <tr>
                    <!--
                    <th>ID</th> 
                    -->
                    <th>メーカー</th>
                    <th>名前</th>
                    <th class="hidden sm:table-cell">購入日</th>
                    <th class="hidden sm:table-cell">価格</th>
                    <th class="hidden sm:table-cell">状態</th>
                    <th class="hidden sm:table-cell">メモ</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipment as $item)
                <tr id="equipment-row-{{ $item->id }}">
                    <!--                     
                    <td>{{ $item->id }}</td> 
                    -->
                    <td>{{ $item->brand }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="hidden sm:table-cell">{{ $item->purchased_at }}</td>
                    <td class="hidden sm:table-cell">{{ $item->price }}</td>
                    <td class="hidden sm:table-cell">{{ $item->status }}</td>
                    <td class="hidden sm:table-cell">{{ $item->notes }}</td>
                    <td class="flex items-start gap-2">
                        {{-- 編集ボタン --}}
                        <a class="btn btn-sm btn-secondary" href="{{ route('equipment.edit', $item->id) }}">
                            編集
                        </a>

                        {{-- Ajax削除ボタン --}}
                        <button type="button" class="btn btn-sm btn-error ajax-delete" data-id="{{ $item->id }}">
                            削除
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Ajax削除スクリプト --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const alertContainer = document.getElementById('alert-container');

    function showAlert(message, type = 'success') {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} shadow-lg mb-2`;
        alert.innerHTML = `<div><span>${message}</span></div>`;
        alertContainer.appendChild(alert);
        setTimeout(() => { alert.remove(); }, 3000);
    }

    const buttons = document.querySelectorAll('.ajax-delete');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            if (!confirm('本当に削除しますか？')) return;

            const url = "{{ url('equipment') }}/" + id;

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById(`equipment-row-${id}`).remove();
                    showAlert('削除しました', 'success');
                } else {
                    showAlert('削除に失敗しました', 'error');
                }
            })
            .catch(() => showAlert('削除に失敗しました', 'error'));
        });
    });
});
</script>
@endsection
