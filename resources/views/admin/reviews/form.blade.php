@php($isEdit = isset($review))

<div class="grid gap-4 lg:grid-cols-12">
    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Property *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="property_id" required>
            <option value="">Select property</option>
            @foreach ($properties as $property)
                <option value="{{ $property->id }}" {{ (string) old('property_id', $review->property_id ?? '') === (string) $property->id ? 'selected' : '' }}>{{ $property->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Booking</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="booking_id">
            <option value="">No booking</option>
            @foreach ($bookings as $booking)
                <option value="{{ $booking->id }}" {{ (string) old('booking_id', $review->booking_id ?? '') === (string) $booking->id ? 'selected' : '' }}>#{{ $booking->id }} - {{ $booking->reference ?? 'N/A' }}</option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-6">
        <label class="text-sm font-medium">Customer</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="customer_id">
            <option value="">Anonymous / guest</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ (string) old('customer_id', $review->customer_id ?? '') === (string) $customer->id ? 'selected' : '' }}>{{ $customer->full_name }}{{ $customer->email ? ' ('.$customer->email.')' : '' }}</option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-3">
        <label class="text-sm font-medium">Rating *</label>
        <select class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="rating" required>
            @foreach ([1,2,3,4,5] as $rating)
                <option value="{{ $rating }}" {{ (int) old('rating', $review->rating ?? 5) === $rating ? 'selected' : '' }}>{{ $rating }}</option>
            @endforeach
        </select>
    </div>

    <div class="lg:col-span-3">
        <label class="inline-flex items-center gap-2 text-sm mt-6">
            <input type="checkbox" class="rounded border" name="is_published" value="1" {{ old('is_published', $review->is_published ?? false) ? 'checked' : '' }}>
            Published
        </label>
    </div>

    <div class="lg:col-span-12">
        <label class="text-sm font-medium">Title</label>
        <input class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="title" value="{{ old('title', $review->title ?? '') }}" placeholder="Great stay">
    </div>

    <div class="lg:col-span-12">
        <label class="text-sm font-medium">Comment</label>
        <textarea class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100" name="comment" rows="5">{{ old('comment', $review->comment ?? '') }}</textarea>
    </div>
</div>
