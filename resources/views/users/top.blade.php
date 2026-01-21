@extends('layouts.app')

@section('title', 'Top')

@section('map-js')
    <script src="{{ asset('js/map.js') }}" defer></script>
@endsection

@section('top-css')
    <link href="{{ mix('css/top.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Hero Section with Modern Design -->
    <div id="first-page" class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container body-top">
            <div class="top d-flex align-items-center justify-content-center" style="min-height: 90vh;">
                <div class="hero-content text-center text-white">
                    <h1 class="display-3 fw-bold mb-4 animate-fade-in">Samurai Travel</h1>
                    <p class="lead mb-5 animate-fade-in-delay">Discover Japan's Hidden Gems with Personalized Travel Plans</p>
                    <div class="top-nav d-flex justify-content-center flex-wrap gap-4 mt-5">
                        <a href="{{ route('search.index') }}" class="hero-btn text-decoration-none text-white d-flex align-items-center justify-content-center">
                            <div>
                                <i class="fa-solid fa-map-location-dot fa-2x mb-2"></i>
                                <div class="fw-bold">Search by Destination</div>
                                <small class="d-block mt-1">Find your perfect place</small>
                            </div>
                        </a>
                        <a href="{{ route('search.index') }}" class="hero-btn text-decoration-none text-white d-flex align-items-center justify-content-center">
                            <div>
                                <i class="fa-solid fa-tags fa-2x mb-2"></i>
                                <div class="fw-bold">Search by Category</div>
                                <small class="d-block mt-1">Hotels, Restaurants & More</small>
                            </div>
                        </a>
                        @guest
                        <a href="{{ route('login') }}" class="hero-btn text-decoration-none text-white d-flex align-items-center justify-content-center">
                            <div>
                                <i class="fa-solid fa-user-plus fa-2x mb-2"></i>
                                <div class="fw-bold">Create Your Plan</div>
                                <small class="d-block mt-1">Start planning today</small>
                            </div>
                        </a>
                        @else
                        <a href="{{ route('suggest-plans.questions') }}" class="hero-btn text-decoration-none text-white d-flex align-items-center justify-content-center">
                            <div>
                                <i class="fa-solid fa-route fa-2x mb-2"></i>
                                <div class="fw-bold">Create Your Plan</div>
                                <small class="d-block mt-1">Start planning today</small>
                            </div>
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container body-top">
        <div class="mt-5 mb-3">
            <h3 class="h3 title text-center mb-3 text-white">We offer itineraries tailored to your preferences!</h3>
            @if ($top_plan)
                @include('users.top.plan')
            @else
                <h3 class="h3 text-center mb-3 text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Sorry, preparing plan now.</h3>
            @endif
        </div>
        <div class="my-5">
            <h3 class="h3 title text-center mb-3 text-white">Pick up</h3>
            <div class="my-5">
                @include('users.top.pickup', ['category' => 'hotel', 'places' => $hotels])
            </div>
            <div class="my-5">
                @include('users.top.pickup', ['category' => 'restaurant', 'places' => $restaurants])
            </div>
            <div class="my-5">
                @include('users.top.pickup', ['category' => 'activity', 'places' => $activities])
            </div>
            <div class="my-5">
                @include('users.top.pickup', ['category' => 'spot', 'places' => $spots])
            </div>
        </div>
        <div class="my-5" id="how-to-create-plan">
            <h3 class="h3 title text-center mb-3">How to create my plan?</h3>
            @include('users.top.how_to')
        </div>
    </div>

@endsection


