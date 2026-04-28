@props([
    'editUrl' => null,
    'deleteUrl' => null,
])

<div class="flex items-center justify-end gap-2">
    @if ($editUrl)
        <a class="rounded-lg border bg-white px-2.5 py-1 text-xs font-semibold hover:bg-slate-50" href="{{ $editUrl }}">
            Edit
        </a>
    @endif

    @if ($deleteUrl)
        <form method="POST" action="{{ $deleteUrl }}" onsubmit="return confirm('Delete this item?')">
            @csrf
            @method('DELETE')
            <button class="rounded-lg border border-red-200 bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-800 hover:bg-red-100" type="submit">
                Delete
            </button>
        </form>
    @endif
</div>

