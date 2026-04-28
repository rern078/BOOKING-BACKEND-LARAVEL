@php($isEdit = isset($setting))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Key *</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="key" required
               value="{{ old('key', $setting->key ?? '') }}"
               placeholder="site.name">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Group</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="group"
               value="{{ old('group', $setting->group ?? '') }}"
               placeholder="site">
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Type</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
               name="type"
               value="{{ old('type', $setting->type ?? '') }}"
               placeholder="string/json/boolean">
    </div>

    <div class="lg:col-span-12">
        <label class="text-sm font-medium">Description</label>
        <textarea class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                  name="description" rows="2"
                  placeholder="What is this setting used for?">{{ old('description', $setting->description ?? '') }}</textarea>
    </div>

    <div class="lg:col-span-12">
        <label class="text-sm font-medium">Value (JSON or plain text)</label>
        <textarea class="mt-1 min-h-[140px] w-full rounded-xl border border-slate-200 bg-white px-3 py-2 font-mono text-xs shadow-sm placeholder:text-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100"
                  name="value_raw"
                  placeholder="Example JSON: {\"enabled\": true}">{{ old('value_raw', isset($setting) ? json_encode($setting->value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
        <p class="mt-2 text-xs text-slate-500">If you enter plain text, it will be stored as <code class="rounded bg-slate-100 px-1 py-0.5">{"value":"..."}</code>.</p>
    </div>
</div>
