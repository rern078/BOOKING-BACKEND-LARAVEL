<x-admin-layout :title="'Jobs'">
    @include('admin.partials.flash')

    <div class="rounded-2xl border bg-white shadow-sm">
        <div class="border-b p-5">
            <div class="text-lg font-semibold">Jobs</div>
            <div class="text-sm text-slate-600">Database queue jobs waiting/processing.</div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                    <tr>
                        <th class="px-5 py-3">ID</th>
                        <th class="px-5 py-3">Queue</th>
                        <th class="px-5 py-3">Attempts</th>
                        <th class="px-5 py-3">Reserved</th>
                        <th class="px-5 py-3">Available</th>
                        <th class="px-5 py-3">Created</th>
                        <th class="px-5 py-3">Payload</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($jobs as $job)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-3 font-semibold">#{{ $job->id }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $job->queue }}</td>
                            <td class="px-5 py-3 text-slate-700">{{ $job->attempts }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $job->reserved_at ? date('Y-m-d H:i', (int) $job->reserved_at) : '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $job->available_at ? date('Y-m-d H:i', (int) $job->available_at) : '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $job->created_at ? date('Y-m-d H:i', (int) $job->created_at) : '-' }}</td>
                            <td class="px-5 py-3 text-slate-600">
                                <div class="flex items-center gap-2">
                                    <span class="rounded bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">{{ strlen((string) $job->payload) }} bytes</span>
                                    <details>
                                        <summary class="cursor-pointer text-xs font-semibold text-slate-700 hover:underline">View</summary>
                                        <pre class="mt-2 max-h-64 overflow-auto rounded-lg border bg-slate-50 p-3 text-xs text-slate-700">{{ $job->payload }}</pre>
                                    </details>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-5 py-8 text-center text-slate-600" colspan="7">No queued jobs.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $jobs->links() }}
        </div>
    </div>
</x-admin-layout>
