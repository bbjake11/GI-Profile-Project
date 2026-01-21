@extends('layouts.app')

@section('title', 'Search by Category')

@section('search-css')
    <link href="{{ mix('css/search.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="search-page-container">
    <div class="search-hero">
        <div class="container">
            <div class="search-hero-content">
                <h1 class="search-main-title">
                    <i class="fa-solid fa-map-location-dot me-3"></i>
                    Explore Japan
                </h1>
                <p class="search-subtitle">Discover amazing places across Japan with our advanced search</p>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <form action="{{ route('search.place') }}" method="get" id="create-search-form">
            <div class="search-body-modern">
                {{-- Search Menu :Category--}}
                <div class="search-section">
                    <div class="search-section-header">
                        <i class="fa-solid fa-tags"></i>
                        <h3 class="search-section-title">Category</h3>
                    </div>
                    <div class="checkbox-list-modern">
                        <label for="category1" class="category-label-modern">
                            <input type="checkbox" {{ (isset($s_category) && in_array('spot', $s_category)) ? 'checked' : '' }} class="category-tag" name="category[]" value="spot" id="category1">
                            <span class="category-tag-text">
                                <i class="fa-solid fa-map-location-dot"></i>
                                Spot
                            </span>
                        </label>
                        <label class="category-label-modern">
                            <input type="checkbox" {{ (isset($s_category) && in_array('restaurant', $s_category)) ? 'checked' : '' }} class="category-tag" name="category[]" value="restaurant">
                            <span class="category-tag-text">
                                <i class="fa-solid fa-utensils"></i>
                                Restaurant
                            </span>
                        </label>
                        <label class="category-label-modern">
                            <input type="checkbox" {{ (isset($s_category) && in_array('hotel', $s_category)) ? 'checked' : '' }} class="category-tag" name="category[]" value="hotel">
                            <span class="category-tag-text">
                                <i class="fa-solid fa-hotel"></i>
                                Hotel
                            </span>
                        </label>
                        <label class="category-label-modern">
                            <input type="checkbox" {{ (isset($s_category)  && in_array('activity', $s_category)) ? 'checked' : '' }} class="category-tag" name="category[]" value="activity">
                            <span class="category-tag-text">
                                <i class="fa-solid fa-mountain-sun"></i>
                                Activity
                            </span>
                        </label>
                    </div>
                </div>
            
                {{-- Add Area-Condition --}}
                <div class="search-section">
                    <div class="search-section-header">
                        <i class="fa-solid fa-map"></i>
                        <h3 class="search-section-title">Area</h3>
                    </div>
                    <div class="checkbox-list-modern">
                        @foreach ($all_areas as $area)
                        <label class="area-label-modern">
                            <input type="checkbox" {{ (isset($s_area) && in_array($area->id, $s_area)) ? 'checked' : '' }} class="area-tag" name="area[]" value="{{ $area->id }}" id="area_id">
                            <span class="area-tag-text">{{ $area->name_en }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="search-section-collapsible">
                    <input id="prefecture-check" class="prefecture-check" type="checkbox" {{ isset($s_prefectures) ? 'checked' : '' }}>
                    <label class="collapsible-header" for="prefecture-check">
                        <i class="fa-solid fa-chevron-down"></i>
                        <span>Add More Prefectures</span>
                    </label>
                    <div class="collapsible-content">
                        <div class="checkbox-list-modern">
                            @foreach ($all_prefectures as $prefecture)
                                @php
                                    $display = '';
                                    if(isset($s_prefectures)) {
                                        $display = !in_array($prefecture->area->id, $s_area) ? 'd-none' : '';
                                    } else {
                                        $display = 'd-none';
                                    }
                                @endphp
                                <label class="prefecture-label-modern {{ $display }}" data-area="{{ $prefecture->area->id  }}">
                                    <input type="checkbox" class="prefecture-tag" {{ (isset($s_prefectures) && in_array($prefecture->id, $s_prefectures)) ? 'checked' : '' }} name="prefecture[]" value="{{ $prefecture->id }}" id="prefecture_id">
                                    <span class="prefecture-tag-text">{{ $prefecture->name_en }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Add Keyword-Condition --}}
                <div class="search-section">
                    <div class="search-section-header">
                        <i class="fa-solid fa-bookmark"></i>
                        <h3 class="search-section-title">Genre</h3>
                    </div>
                    <div class="checkbox-list-modern">
                        @foreach ($all_genres as $genre)
                        <label class="genre-label-modern">
                            <input type="checkbox" {{ (isset($s_genre) && in_array($genre->id, $s_genre)) ? 'checked' : '' }} class="genre-tag" name="genre[]" value="{{ $genre->id }}" id="genre_id">
                            <span class="genre-tag-text">{{ $genre->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="search-section-collapsible">
                    <input id="keyword-check" class="keyword-check" type="checkbox" {{ isset($s_keywords) ? 'checked' : '' }}>
                    <label class="collapsible-header" for="keyword-check">
                        <i class="fa-solid fa-chevron-down"></i>
                        <span>Add More Genres & Keywords</span>
                    </label>
                    <div class="collapsible-content">
                        <div class="checkbox-list-modern">
                            @foreach ($all_keywords as $keyword)
                                @php
                                    $display = '';
                                    if(isset($s_keywords)) {
                                        $display = !in_array($keyword->genre->id, $s_genre) ? 'd-none' : '';
                                    } else {
                                        $display = 'd-none';
                                    }
                                @endphp
                                <label class="keyword-label-modern {{ $display }}" data-genre="{{ $keyword->genre->id }}">
                                    <input type="checkbox" class="keyword-tag" {{ (isset($s_keywords) && in_array($keyword->id, $s_keywords)) ? 'checked' : '' }} name="keyword[]" value="{{ $keyword->id }}" id="keyword_id">
                                    <span class="keyword-tag-text">{{ $keyword->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Button --}}
                <div class="search-actions">
                    <a href="{{ route('search.index') }}" class="btn-reset">
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </a>
                    <button type="submit" class="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                </div>
            </div>
        </form>

    {{-- Show Places --}}
    <div class="show-place mt-5">
        @include('users.search.search_details.place')
    </div>
    
</div>
<script>
    // Update checkbox styling on change
    function updateCheckboxStyling() {
        $('.category-tag, .area-tag, .genre-tag, .prefecture-tag, .keyword-tag').each(function() {
            const $label = $(this).closest('label');
            if ($(this).is(':checked')) {
                $label.addClass('checked');
            } else {
                $label.removeClass('checked');
            }
        });
    }

    // Initialize checkbox styling
    $(document).ready(function(){
        updateCheckboxStyling();
        
        // Update on change
        $('.category-tag, .area-tag, .genre-tag, .prefecture-tag, .keyword-tag').on('change', function() {
            updateCheckboxStyling();
        });
    });

    // To show prefectures related to the designated Area
    $(document).ready(function(){
        var area_ids = [];
        $('.area-tag').change(function() {
            let value = $(this).val();
            let index = area_ids.indexOf(parseInt(value))
            if($(this).is(':checked')) {
                if(index == -1) {
                    area_ids.push(parseInt($(this).val()))
                }
            } else {
                area_ids.splice(index, 1);
            }
            $('.prefecture-label-modern').each(function() {
                if(area_ids.length == 0) {
                    $('.prefecture-label-modern').addClass('d-none');
                } else {
                    if(area_ids.indexOf(parseInt($(this).data('area'))) > -1) {
                        $(this).removeClass('d-none');
                    } else {
                        $(this).addClass('d-none')
                    }
                }
            });
        });
    });

    // To show keywords related to the designated Genre
    $(document).ready(function(){
        var genre_ids = [];
        $('.genre-tag').change(function() {
            let value = $(this).val();
            let index = genre_ids.indexOf(parseInt(value))
            if($(this).is(':checked')) {
                if(index == -1) {
                    genre_ids.push(parseInt($(this).val()))
                }
            } else {
                genre_ids.splice(index, 1);
            }
            $('.keyword-label-modern').each(function() {
                if(genre_ids.length == 0) {
                    $('.keyword-label-modern').addClass('d-none');
                } else {
                    if(genre_ids.indexOf(parseInt($(this).data('genre'))) > -1) {
                        $(this).removeClass('d-none');
                    } else {
                        $(this).addClass('d-none')
                    }
                }
            });
        });
    });
</script>
@endsection