@extends('layouts.app')

@section('title', 'My Page')

@section('my-page-css')
    <link href="{{ mix('css/my-page.css') }}" rel="stylesheet">
@endsection

@section('content')

@php
    $interest_span_class = 'interest-badge';
    $interest_i_class = 'fa-solid fa-circle-xmark remove-interest';
@endphp

<div class="my-page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="profile-section">
                    <div id="div-profile" class="profile-avatar-wrapper" data-bs-toggle="modal" data-bs-target="#profile">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset("storage/avatar/".Auth::user()->avatar) }}" alt="avatar" class="profile-avatar"/>
                        @else
                            <div class="profile-avatar-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <a class="profile-name" href="#" id="username">{{ Auth::user()->first_name." ".Auth::user()->last_name}}</a>
                    <div class="edit-profile-badge" data-bs-toggle="modal" data-bs-target="#profile">
                        <i class="fa-solid fa-pen"></i>
                        <span>Edit Profile</span>
                    </div>
                    @include('users.my_page.modal.profile')
                </div>
            </div>
            <div class="col-md-8">
                <div class="favorite-places-container">
                    <div class="section-header section-header-dark">
                        <i class="fa-solid fa-heart"></i>
                        <h3>My Favorite Places</h3>
                    </div>
                    @if($place_favorites->count() > 0)
                        <div class="favorite-places-grid">
                            @foreach ($place_favorites as $place_favorite)
                                <div id="place-favorite-{{ $place_favorite->place_id }}" class="place-favorite-card">
                                    @if($place_favorite->place->image)
                                        <img src="{{ asset("storage/sample/{$place_favorite->place->image}") }}" alt="{{ $place_favorite->place->name_en }}" class="place-favorite-image" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=400&q=80';">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=400&q=80" alt="{{ $place_favorite->place->name_en }}" class="place-favorite-image">
                                    @endif
                                    <div class="place-favorite-overlay">
                                        <h5 class="place-favorite-name">{{ $place_favorite->place->name_en }}</h5>
                                    </div>
                                    <div class="place-favorite-actions">
                                        <a href="{{ route('placedetails', $place_favorite->place_id) }}" class="action-btn" title="View Details">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                        <button type="button" id="place-favorite-i-{{ $place_favorite->place_id }}" class="action-btn delete-btn" title="Remove">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fa-solid fa-heart"></i>
                            <h3>No Favorite Places Yet</h3>
                            <p>Start exploring and add places to your favorites!</p>
                            <a href="{{ route('search.index') }}" class="btn btn-primary mt-3">
                                <i class="fa-solid fa-search me-2"></i>Explore Places
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Favorite Plans Section -->
    <div class="plans-section">
        <div class="section-header section-header-dark">
            <i class="fa-solid fa-bookmark"></i>
            <h3>My Favorite Plans</h3>
        </div>
        @if($plan_favorites->count() > 0)
            <ul class="slider p-0" id="slider-plan-favorite">
                @foreach ($plan_favorites as $plan_favorite)
                    <li>
                        @php $plan = $plan_favorite->plan; @endphp
                        <div class="plan-div" style="position: relative;">
                            @include('users.my_page.plan')
                            <button type="button" id="plan-favorite-i-{{ $plan_favorite->id }}" class="action-btn delete-btn" style="position: absolute; top: 15px; right: 15px;" title="Remove from favorites">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="empty-state">
                <i class="fa-solid fa-bookmark"></i>
                <h3>No Favorite Plans Yet</h3>
                <p>Browse recommended plans and add them to your favorites!</p>
            </div>
        @endif
    </div>

    <!-- My Own Plans Section -->
    <div class="plans-section">
        <div class="section-header section-header-dark">
            <i class="fa-solid fa-route"></i>
            <h3>My Own Plans</h3>
        </div>
        @if($my_plans->count() > 0)
            <ul class="slider p-0" id="slider-my-plan">
                @foreach ($my_plans as $plan)
                    <li>
                        <div class="my-plan-div" style="position: relative;">
                            @include('users.my_page.plan')
                            <button type="button" id="my-plan-i-{{ $plan->id }}" class="action-btn delete-btn" style="position: absolute; top: 15px; right: 15px;" title="Delete plan">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="empty-state">
                <i class="fa-solid fa-route"></i>
                <h3>No Plans Created Yet</h3>
                <p>Create your first personalized travel plan!</p>
                <a href="{{ route('suggest-plans.questions') }}" class="btn btn-primary mt-3">
                    <i class="fa-solid fa-plus me-2"></i>Create Plan
                </a>
            </div>
        @endif
    </div>


    <!-- Interests Section -->
    <div class="interests-section">
        <div class="interests-header" onclick="toggleInterests()">
            <h4>
                <i class="fa-solid fa-tags"></i>
                <span>My Interests</span>
                <i class="fa-solid fa-chevron-down ms-auto" id="interests-chevron"></i>
            </h4>
        </div>
        <div id="open" class="interests-content {{ $interests->count() > 0 ? 'open' : '' }}">
            <div id="interest-grp" class="interests-list">
                @foreach ($interests as $interest)
                    <span id="interest-{{ $interest->id }}" class="{{ $interest_span_class }}">
                        <span>{{ $interest->keyword->name }}</span>
                        <i id="interest-i-{{ $interest->id }}" class="{{ $interest_i_class }}"></i>
                    </span>
                @endforeach
                @if($interests->count() === 0)
                    <p class="text-muted">No interests added yet. Add some keywords to get personalized recommendations!</p>
                @endif
            </div>
            <div class="add-interest-form">
                <select name="keyword" id="keyword-select" style="width: 100%;"></select>
                <button type="button" id="add-keyword" class="btn-add-interest">
                    <i class="fa-solid fa-plus"></i>
                    Add Interest
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function toggleInterests() {
    const content = document.getElementById('open');
    const chevron = document.getElementById('interests-chevron');
    if (content.classList.contains('open')) {
        content.classList.remove('open');
        chevron.style.transform = 'rotate(0deg)';
    } else {
        content.classList.add('open');
        chevron.style.transform = 'rotate(180deg)';
    }
}

// Initialize chevron rotation if interests section is open
document.addEventListener('DOMContentLoaded', function() {
    const content = document.getElementById('open');
    const chevron = document.getElementById('interests-chevron');
    if (content && content.classList.contains('open')) {
        chevron.style.transform = 'rotate(180deg)';
    }
});
</script>


<script type="text/javascript">

    function addInterest(){
        // Get the selected keyword id
        const keyword_id = $('select[name="keyword"]').val();

        // If no keyword is selected, do nothing
        if (!keyword_id) {
            return;
        }

        $.ajax({
            // Register interest
            type: "POST",
            url: "/my_page/interests/store",
            data: { keyword_id : keyword_id },
            dataType: "json",

        }) .then((res) => {
            if (res.result === 'OK') {
                // In case of success response
                if (res.interest_id) {
                    // Create a new span element
                    const span = document.createElement('span');
                    span.id = `interest-${res.interest_id}`;
                    span.className = interest_span_class;
                    
                    // Create text span
                    const textSpan = document.createElement('span');
                    textSpan.textContent = res.keyword_name;
                    span.appendChild(textSpan);

                    // Create a new i element
                    const i = document.createElement('i');
                    i.id = `interest-i-${res.interest_id}`;
                    i.className = interest_i_class;
                    span.appendChild(i);
                    i.addEventListener('click', function(event) {
                        removeInterest(res.interest_id);
                    });

                    // Add the new span element to the DOM
                    const interest_grp = document.getElementById('interest-grp');
                    // Remove empty message if exists
                    const emptyMsg = interest_grp.querySelector('p.text-muted');
                    if (emptyMsg) {
                        emptyMsg.remove();
                    }
                    interest_grp.appendChild(span);
                }
            } else {
                // In case of failure response
                console.log(res.result);
            }

            // Reset the select2 element
            $('#keyword-select').val(null).trigger('change');

        }) .fail((error) => {
            console.log(error.statusText);
        });
    }

    function removeInterest(id){
        $.ajax({
            // Delete interest
            type: "DELETE",
            url: `/my_page/interests/${id}/destroy`,

        }) .then((res) => {
            if (res.result === 'OK') {
                // In case of success response

                // Remove the span element from the DOM
                const interest = document.getElementById(`interest-${id}`);
                interest.remove();
            } else {
                // In case of failure response
                console.log(res.result);
            }

        }) .fail((error) => {
            console.log(error.statusText);
        });
    }

    function removePlaceFavorite(place_id){
        $.ajax({
            // Delete place favorite
            type: "DELETE",
            url: `/my_page/place_favorites/${place_id}/destroy`,

        }) .then((res) => {
            if (res.result === 'OK') {
                // In case of success response

                // Remove the div element from the DOM
                const place_favorite = document.getElementById(`place-favorite-${place_id}`);
                place_favorite.remove();
            } else {
                // In case of failure response
                console.log(res.result);
            }

        }) .fail((error) => {
            console.log(error.statusText);
        });
    }

    function removePlanFavorite(id, x_icon){
        $.ajax({
            // // Delete plan favorite
            type: "DELETE",
            url: `/my_page/plan_favorites/${id}/destroy`,

        }) .then((res) => {
            if (res.result === 'OK') {
                // In case of success response

                // Remove the slide from the DOM
                removeSlide('slider-plan-favorite', x_icon);
            } else {
                // In case of failure response
                console.log(res.result);
            }

        }) .fail((error) => {
            console.log(error.statusText);
        });
    }

    function removeMyPlan(id, x_icon){
        $.ajax({
            // Delete my plan
            type: "DELETE",
            url: `/my_page/my_plan/${id}/destroy`,

        }) .then((res) => {
            if (res.result === 'OK') {
                // In case of success response

                // Remove the slide from the DOM
                removeSlide('slider-my-plan', x_icon);
            } else {
                // In case of failure response
                console.log(res.result);
            }

        }) .fail((error) => {
            console.log(error.statusText);
        });
    }

    function removeSlide(slider_id, x_icon){
        // Get the index of the slide to be clicked
        let slide_lis = document.querySelectorAll(`#${slider_id} .slick-slide`);
        slide_lis = [].slice.call(slide_lis);

        const slide_li = x_icon.parentNode.parentNode;
        const index = slide_lis.indexOf( slide_li ) ;

        // Remove the slide element from the DOM
        $(`#${slider_id}`).slick('slickRemove', index, false);
    }

    function setClickEventToXIcon(records, id_name, x_icon_id_str, remove_func, is_slide=false){
        const x_icons = {};
        records.forEach(
            function (record) {
                // Get the x icon element each record
                x_icons[record[id_name]] = document.getElementById(`${x_icon_id_str}-${record[id_name]}`);

                // Set the click event to the x icon element
                x_icons[record[id_name]].addEventListener('click', function(event) {
                    if (is_slide){
                        // In case of slide
                        remove_func(record[id_name], x_icons[record[id_name]]);
                    } else {
                        remove_func(record[id_name]);
                    }
                });
            }
        );
    }


    // Receive data from html
    const interest_span_class = @json($interest_span_class);
    const interest_i_class = @json($interest_i_class);
    const interests = @json($interests);
    const place_favorites = @json($place_favorites);
    const plan_favorites = @json($plan_favorites);
    const my_plans = @json($my_plans);

    // CSRF Token
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // select2 for Searching Keywords
    $('#keyword-select').select2({
        placeholder: 'Select a keyword',
        allowClear: true,
        ajax: {
            url: '/my_page/keywords',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id,
                        }
                    })
                };
            },
            cache: true,
        }
    });

    // Set event listener to add button
    const add_keyword = document.getElementById('add-keyword');
    add_keyword.addEventListener('click', addInterest);

    let remove_func;

    // Set event listener to each interest
    remove_func = removeInterest;
    setClickEventToXIcon(interests, 'id', 'interest-i', remove_func);

    // Set event listener to each place favorite
    remove_func = removePlaceFavorite;
    setClickEventToXIcon(place_favorites, 'place_id', 'place-favorite-i', remove_func);

    // Set event listener to each plan favorite
    remove_func = removePlanFavorite;
    setClickEventToXIcon(plan_favorites, 'id', 'plan-favorite-i', remove_func, true);

    // Set event listener to each my plan
    remove_func = removeMyPlan;
    setClickEventToXIcon(my_plans, 'id', 'my-plan-i', remove_func, true);

</script>

@endsection
