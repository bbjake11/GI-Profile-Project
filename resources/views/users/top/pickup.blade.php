<div class="">
    @if ($places->isNotEmpty())
        <div class="main-content row">
            <div class="col">
                @if ($places[0]->image)
                    <img src="{{ asset("/storage/sample/{$places[0]->image}") }}" class="img-lg" alt="{{ $places[0]->image }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=800&q=80';">
                @else
                    @php
                        $categoryImages = [
                            'hotel' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
                            'restaurant' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80',
                            'activity' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80',
                            'spot' => 'https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=800&q=80'
                        ];
                        $defaultImage = $categoryImages[$category] ?? 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=800&q=80';
                    @endphp
                    <img src="{{ $defaultImage }}" class="img-lg" alt="{{ $category }}">
                @endif
            </div>
            <div class="col col-white pickup-content-card">
                <div class="pickup-header">
                    <div class="category-icon-wrapper">
                        @php
                            $categoryIcons = [
                                'hotel' => 'fa-hotel',
                                'restaurant' => 'fa-utensils',
                                'activity' => 'fa-mountain-sun',
                                'spot' => 'fa-map-location-dot'
                            ];
                            $icon = $categoryIcons[$category] ?? 'fa-map-location-dot';
                        @endphp
                        <i class="fa-solid {{ $icon }} category-icon"></i>
                    </div>
                    <h4 class="category-title text-capitalize">{{ ucfirst($category) }}</h4>
                    <div class="category-divider"></div>
                </div>
                <div class="pickup-body">
                    @if($places[0]->description)
                        <p class="place-desc">{{ $places[0]->description }}</p>
                    @else
                        <p class="place-desc-placeholder">
                            Discover amazing {{ $category }}s across Japan. From traditional experiences to modern attractions, 
                            find the perfect places to enhance your travel journey.
                        </p>
                    @endif
                    <div class="pickup-features">
                        <div class="feature-item">
                            <i class="fa-solid fa-star text-warning"></i>
                            <span>Top Rated</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-users text-info"></i>
                            <span>Popular</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-heart text-danger"></i>
                            <span>Recommended</span>
                        </div>
                    </div>
                </div>
                <div class="pickup-footer">
                    <a href="{{ route('search.index') }}" class="btn-search-more">
                        <span>Explore More</span>
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex mt-3 p-2 bg-dark rounded">
                <h6 class="h6 text-white mb-0 fw-bold">{{ $places[0]->name_en }}</h6>
                <div class="ms-auto d-flex align-items-center">
                    <i class="fa-solid fa-location-dot text-white me-2"></i>
                    <h6 class="h6 text-white mb-0">{{ $places[0]->prefecture->name_en }}</h6>
                </div>
            </div>
        </div>
        <div class="mt-5 mb-3 text-center">
            <h5 class="h5 text-white fw-bold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Other Recommendations</h5>
        </div>
        @if ($places->count() > 1)
            <div class="sub-content row">
                @for ($i = 1; $i < $places->count(); $i++)
                    <div class="col-4 mb-4">
                        @if ($places[$i]->image)
                            <a href="{{ route('placedetails', $places[$i]->id) }}" class="place-card-link">
                                <div class="place-image-wrapper">
                                    <img src="{{ asset("/storage/sample/{$places[$i]->image}") }}" class="img-lg place-image" alt="{{ $places[$i]->image }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=800&q=80';">
                                    <div class="place-overlay"></div>
                                    <div class="place-info-overlay">
                                        <h6 class="h6 text-white fw-bold mb-1">{{ $places[$i]->name_en }}</h6>
                                        <div class="d-flex align-items-center text-white">
                                            <i class="fa-solid fa-location-dot me-2"></i>
                                            <span class="small">{{ $places[$i]->prefecture->name_en }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @else
                            @php
                                // Get appropriate image based on place name for better context
                                $placeName = strtolower($places[$i]->name_en);
                                $placeImage = '';
                                
                                if (strpos($placeName, 'eel') !== false || strpos($placeName, 'restaurant') !== false) {
                                    $placeImage = 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80'; // Japanese restaurant
                                } elseif (strpos($placeName, 'railway') !== false || strpos($placeName, 'museum') !== false) {
                                    $placeImage = 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&q=80'; // Museum/train
                                } elseif (strpos($placeName, 'jingu') !== false || strpos($placeName, 'shrine') !== false || strpos($placeName, 'temple') !== false) {
                                    $placeImage = 'https://images.unsplash.com/photo-1528164344705-47542687000d?w=800&q=80'; // Japanese shrine
                                } else {
                                    $categoryImages = [
                                        'hotel' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
                                        'restaurant' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80',
                                        'activity' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80',
                                        'spot' => 'https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=800&q=80'
                                    ];
                                    $placeImage = $categoryImages[$category] ?? 'https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=800&q=80';
                                }
                            @endphp
                            <a href="{{ route('placedetails', $places[$i]->id) }}" class="place-card-link">
                                <div class="place-image-wrapper">
                                    <img src="{{ $placeImage }}" class="img-lg place-image" alt="{{ $category }}">
                                    <div class="place-overlay"></div>
                                    <div class="place-info-overlay">
                                        <h6 class="h6 text-white fw-bold mb-1">{{ $places[$i]->name_en }}</h6>
                                        <div class="d-flex align-items-center text-white">
                                            <i class="fa-solid fa-location-dot me-2"></i>
                                            <span class="small">{{ $places[$i]->prefecture->name_en }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                @endfor
            </div>
        @else
            <h5 class="h5 text-center mb-3 text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Sorry, preparing {{ $category }} now.</h5>
        @endif
    @else
        <h3 class="h3 text-center mb-3 text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Sorry, preparing {{ $category }} now.</h3>
    @endif
</div>