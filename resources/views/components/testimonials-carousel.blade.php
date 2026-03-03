@if($testimonials ?? null)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ currentIndex: 0 }">
    @foreach($testimonials as $testimonial)
    <div class="bg-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center mb-4">
            <div class="flex text-amber-400">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $testimonial->rating)
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @else
                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endif
                @endfor
            </div>
        </div>
        <p class="text-gray-600 mb-4 italic">"{{ $testimonial->review }}"</p>
        <div class="flex items-center">
            <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center mr-4">
                <span class="text-sky-600 font-bold text-lg">{{ substr($testimonial->customer_name, 0, 1) }}</span>
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">{{ $testimonial->customer_name }}</h4>
                @if($testimonial->package)
                <p class="text-sm text-gray-500">{{ $testimonial->package->name }}</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center text-gray-500 py-12">
    <p>No testimonials available yet.</p>
</div>
@endif
