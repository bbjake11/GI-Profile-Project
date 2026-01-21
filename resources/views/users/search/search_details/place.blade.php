@if(!empty($places))
    <div class="search-results-container">
        <h3 class="results-title">
            <i class="fa-solid fa-list"></i>
            Search Results ({{ $places->count() }})
        </h3>
        <div class="places-grid">
            @foreach ($places as $place)
                <div class="place-card-modern">
                    <a href="{{ route('placedetails', $place) }}" class="place-card-link-modern">
                        <div class="place-image-container">
                            @if($place->image)
                                <img src="{{ asset('storage/sample/' . $place->image) }}" alt="{{ $place->name_en }}" class="place-image-modern" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=400&q=80';">
                            @else
                                <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=400&q=80" alt="{{ $place->name_en }}" class="place-image-modern">
                            @endif
                            <div class="place-overlay-modern"></div>
                            <div class="place-category-badge">
                                <i class="fa-solid fa-{{ $place->place_category == 'hotel' ? 'hotel' : ($place->place_category == 'restaurant' ? 'utensils' : ($place->place_category == 'activity' ? 'mountain-sun' : 'map-location-dot')) }}"></i>
                                {{ ucfirst($place->place_category) }}
                            </div>
                        </div>
                        <div class="place-card-body">
                            <h4 class="place-name">{{ $place->name_en }}</h4>
                            <div class="place-location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>{{ $place->prefecture->name_en ?? $place->address }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="no-results">
        <i class="fa-solid fa-search"></i>
        <h3>No places found</h3>
        <p>Try adjusting your search criteria</p>
    </div>
@endif
{{-- <div class="row">
    @if(!empty($places))
        @foreach ($places->chunk(2) as $chunk)
            <div class="col-6 mb-3">
                @foreach ($chunk as $index => $place)
                    <div class="d-flex mt-1">
                        <a href="">
                            <img src="{{ asset('storage/sample/' . $place->image) }}" alt="{{ $place->image }}" class="place-img img-s img-fluid">
                        </a>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="h6">{{ $place->name_en }}</span>
                        </div>
                        <div class="col">
                            <i class="fa-solid fa-location-dot"></i>
                            <span class="h6"> {{ $place->address }}</span>
                        </div>
                    </div>
                    @if ($index % 2 == 0)
            </div>
            <div class="col-6 mb-3">
                    @endif
                @endforeach
            </div>
        @endforeach
    @endif
</div> --}}


