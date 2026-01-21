@extends('layouts.app')

@section('title', 'Questions')

@section('suggest-plans-css')
    <link href="{{ mix('css/suggest-plans.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="questions-hero">
        <div class="container">
            <div class="questions-hero-content">
                <h1 class="questions-title">
                    <i class="fa-solid fa-compass me-3"></i>
                    Plan Suggestions
                </h1>
                <p class="questions-subtitle">Answer a few questions to get personalized travel recommendations</p>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="q-box-modern col-lg-8 col-md-10 col-12">
                <div class="question-header">
                    <div class="question-number">
                        <i class="fa-solid fa-question-circle me-2"></i>
                        Question {{ session('question_no') ?? 1 }} of 5
                    </div>
                    <div class="progress-bar-container">
                        @php
                            $questionNo = session('question_no') ?? 1;
                            $progress = ($questionNo / 5) * 100;
                        @endphp
                        <div class="progress-bar-fill" style="width: {{ $progress }}%"></div>
                    </div>
                </div>

                <form id="search-button" method="GET" class="question-form">
                    @if(isset($question) && $question)
                        <div class="question-text">
                            <h2>{{ $question->question }}</h2>
                        </div>
                        
                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                        
                        <div class="answers-container">
                            @foreach ($question->answers as $answer)
                            <div class="answer-option">
                                <input class="answer-checkbox" type="checkbox" value="{{$answer->id}}" name="answer[]" id="answer-{{$loop->iteration}}">
                                <label class="answer-label" for="answer-{{$loop->iteration}}">
                                    <span class="answer-text">{{$answer->answer}}</span>
                                    <i class="fa-solid fa-check answer-check-icon"></i>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-exclamation-triangle me-2"></i>
                            No question available. Please try again.
                        </div>
                    @endif

                    @if(isset($question) && $question)
                    <div class="form-actions">
                        <button type="submit" value="search-now" class="btn-search-now">
                            <i class="fa-solid fa-search me-2"></i>
                            Search up to here
                        </button>
                        
                        <div class="next-button-wrapper">
                            @php
                                $currentQuestion = session('question_no') ?? 1;
                            @endphp
                            @if ($currentQuestion < 5)
                                <button type="submit" value="next" class="btn-next">
                                    Next Question
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            @else
                                <button type="submit" value="search" class="btn-search-final">
                                    <i class="fa-solid fa-magic me-2"></i>
                                    Generate My Plan
                                </button>
                            @endif
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('search-button').addEventListener('submit', function(event) {
                    var submitType = event.submitter.value;

                    if (submitType === 'next') {
                        this.action = "{{ route('suggest-plans.questions') }}";
                    } else {
                        this.action = "{{ route('suggest-plans.show', Auth::user()->id) }}";
                    }
                });
            });
        </script>
    </div>
@endsection