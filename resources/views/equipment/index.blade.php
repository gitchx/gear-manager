<x-app-layout>
<div class="container mx-auto px-4 sm:px-6 lg:px-8">

    <h1 class="text-2xl font-bold mb-4 mt-3">機材一覧</h1>

    {{-- 新規作成ボタン --}}
    <div class="mb-4">
        <button class="btn bg-gray-200 w-full sm:w-auto text-gray-700" onclick="location.href='{{ route('equipment.create') }}'">
            新規作成
        </button>
    </div>

    {{-- カテゴリー絞り込み --}}
    <form method="GET" class="mb-4 flex gap-2 items-center">
        <select name="category" class="select select-bordered">
            <option value="all" {{ request('category') === 'all' ? 'selected' : '' }}>すべてのカテゴリー</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">絞り込む</button>
    </form>

    {{-- アラート用コンテナ --}}
    <div id="alert-container" class="fixed top-4 right-4 z-50"></div>

    {{-- 機材テーブル --}}
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full text-sm sm:text-base">

            <thead>
                <tr>
                    <th class="w-1">カテゴリ</th>
                    <th>メーカー</th>
                    <th>名前</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipment as $item)
                <!-- スマホ用メイン行 -->
                <tr class="sm:hidden" id="equipment-row-{{ $item->id }}">
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->brand }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="flex flex-col gap-2">
                        <button class="btn btn-sm btn-ghost toggle-details bg-gray-300" data-id="{{ $item->id }}">詳細</button>
                        <a class="btn btn-sm bg-gray-400 text-white" href="{{ route('equipment.edit', $item->id) }}">編集</a>
                    </td>
                </tr>
                <!-- スマホ用折りたたみ詳細行 -->
                <tr id="details-{{ $item->id }}" class="hidden sm:hidden bg-gray-50">
                    <td colspan="3">
                        <div class="grid grid-cols-2 gap-2 p-2">
                            <div><strong>カテゴリ:</strong> {{ $item->category }}</div>
                            <div><strong>購入日:</strong> {{ $item->purchased_at }}</div>
                            <div><strong>価格:</strong> {{ $item->price }}</div>
                            <div><strong>状態:</strong> {{ $item->status }}</div>
                            <div class="col-span-2"><strong>メモ:</strong> {{ $item->notes }}</div>
                        </div>
                        <div class="col-span-2 text-right">
                            <button type="button" class="btn btn-sm btn-error ajax-delete text-white" data-id="{{ $item->id }}">削除</button>
                        </div>
                    </td>
                </tr>

                <!-- PC用全表示行 -->
                <tr class="hidden sm:table-row" id="equipment-row-pc-{{ $item->id }}">
                    <td>{{ $item->brand }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->purchased_at }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->notes }}</td>
                    <td class="flex items-center gap-2">
                        <a class="btn btn-sm bg-gray-400 text-white" href="{{ route('equipment.edit', $item->id) }}">編集</a>
                        <button type="button" class="btn btn-sm btn-error ajax-delete text-white" data-id="{{ $item->id }}">削除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Ajax削除 + 折りたたみトグル --}}
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

    // Ajax削除
    document.querySelectorAll('.ajax-delete').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            if (!confirm('本当に削除しますか？')) return;

            fetch("{{ url('equipment') }}/" + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById(`equipment-row-${id}`)?.remove();
                    document.getElementById(`details-${id}`)?.remove();
                    document.getElementById(`equipment-row-pc-${id}`)?.remove();
                    showAlert('削除しました', 'success');
                } else {
                    showAlert('削除に失敗しました', 'error');
                }
            })
            .catch(() => showAlert('削除に失敗しました', 'error'));
        });
    });

    // 詳細トグル
    document.querySelectorAll('.toggle-details').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const detailsRow = document.getElementById(`details-${id}`);
            detailsRow.classList.toggle('hidden');
        });
    });
});
</script>

</x-app-layout>