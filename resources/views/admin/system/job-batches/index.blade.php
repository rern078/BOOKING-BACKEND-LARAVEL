<x-admin-layout :title="'Job Batches'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="border-b p-5">
            <div class="text-lg font-semibold">Job Batches</div>
            <div class="text-sm text-slate-600">Batch processing status.</div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">ID</th>
                        <th class="px-5 py-3">Name</th>
                        <th class="px-5 py-3">Pending</th>
                        <th class="px-5 py-3">Failed</th>
                        <th class="px-5 py-3">Created</th>
                        <th class="px-5 py-3">Finished</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($batches as $batch)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-mono text-xs text-slate-700">{{ $batch->id }}</td>
                            <td class="px-5 py-3 text-slate-700">
                                <div class="font-semibold">{{ $batch->name }}</div>
                                <div class="text-xs text-slate-500">Total: {{ $batch->total_jobs }}, Cancelled: {{ $batch->cancelled_at ? 'Yes' : 'No' }}</div>
                            </td>
                            <td class="px-5 py-3 font-semibold">{{ $batch->pending_jobs }}</td>
                            <td class="px-5 py-3 font-semibold">{{ $batch->failed_jobs }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $batch->created_at ? date('Y-m-d H:i', (int) $batch->created_at) : '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $batch->finished_at ? date('Y-m-d H:i', (int) $batch->finished_at) : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="6">No job batches.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $batches->links() }}
        </div>
    </div>
</x-admin-layout>
