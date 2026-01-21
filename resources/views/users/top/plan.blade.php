<div>
    <div class="shadow p-5 rounded bg-white">
        <a href="{{ route('show.plan', $top_plan['id']) }}" class="text-decoration-none">
            <h4 class="h4 text-capitalize text-dark">{{ $top_plan['title'] }}</h4>
        </a>
        <div class="row">
            <div class="col ">
                <ul class="nav nav-pills mb-3" id="tab-1" role="tablist">
                    @for ($i = 1; $i <= 3; $i++)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $i === 1 ? 'active' : '' }}" id="plan-1-{{ $i }}-tab" data-bs-toggle="pill" data-bs-target="#plan-1-{{ $i }}" type="button" role="tab" aria-controls="plan-1-{{ $i }}" aria-selected="{{ $i === 1 ? 'true' : 'false' }}">Day {{ $i }}</button>
                        </li>
                    @endfor
                </ul>
            </div>
            <div class="row">
                <div class="col tab-content" id="plan-1-tab-content">

                    {{-- each day --}}
                    @php $count_day = 0; @endphp
                    @foreach ($top_plan['days'] as $one_day)
                        @php $count_day++; @endphp

                        <div class="tab-pane fade {{ $count_day === 1 ? 'show active' : '' }}" id="plan-1-{{ $count_day }}" role="tabpanel" aria-labelledby="plan-1-{{ $count_day }}-tab" tabindex="0">

                        {{-- each place --}}
                        @php $count_place = 0; @endphp
                        @foreach ($one_day as $place)
                            @php $count_place++; @endphp

                            @if ($count_place !== 1)
                                {{-- display time to go to next place --}}
                                <div class="float-start"><i class="fa-solid fa-arrow-down-long"></i></div>
                                <div class="">
                                    <i class="fa-solid fa-car"></i> {{ $transfer_minute }} min
                                </div>
                            @endif

                            <div>
                                <div class="bg-plan p-2">
                                    <div class="p-2">
                                        <i class="fa-regular fa-clock"></i> {{ $place['arrival_time'] }}
                                        <i class="fa-solid fa-location-dot"></i> {{ $place['name_en'] }}
                                    </div>
                                    <div class="d-flex">
                                        <div class="px-2">
                                            @if ($place['image'])
                                                <a href="{{ route('placedetails', $place['place_id']) }}">
                                                    <img src="{{ asset("/storage/sample/{$place['image']}") }}" class="img-sm" alt="{{ $place['image'] }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=400&q=80';">
                                                </a>
                                            @else
                                                <a href="{{ route('placedetails', $place['place_id']) }}">
                                                    <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=400&q=80" class="img-sm" alt="Japan travel">
                                                </a>
                                            @endif
                                        </div>
                                        <p class="place-desc px-2">{{ $place['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </div>
                    @endforeach

                </div>
                <div class="col map" id="map_123"></div>
                <script src="https://maps.googleapis.com/maps/api/js?key={{ config('api.google_map_api_key') }}&callback=initMap" defer>
                </script>
            </div>
        </div>
    </div>
    <form class="" action="#" method="post">
        <div class="d-flex text-center mt-4 row">
            <div class="col">
                <a href="{{ route('suggest-plans.questions') }}" class="btn btn-light btn-outline-dark rounded-pill h6">Let's create your plan!</a>
            </div>
            <div class="col">
                <a href="#how-to-create-plan" class="btn btn-light btn-outline-dark rounded-pill h6">How to create?</a>
            </div>
        </div>
    </form>
    <script>
        const gm_plan = {!! json_encode($gm_plan) !!};
    </script>
</div>
