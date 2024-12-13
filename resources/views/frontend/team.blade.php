@extends('frontend.layouts.master')

@section('content')
<!-- Herosection -->
<section class="herosectionforallpage my-4">
    <div class="container">
        <!-- Hero section content if needed -->
    </div>
</section>

<div class="container">
    <h1 class="page_title">{{ $page_title }}</h1>
</div>

<section class="multi_post">
    <div class="container">
        <div class="multi_poster row justify-content-center row-gap-5 gap-5">
            @if($teams->isEmpty())
                <p class="alert alert-warning">No team members found for {{ $page_title }}</p>
            @else
                @foreach($teams as $team)
                    <div class="card col-lg-3">
                        <div class="multi_post_image">
                            @if($team->image)
                          
                                <img src="{{ asset('uploads/team/' . $team->image) }}" class="card-img-top" alt="{{ $team->name }}">
                            @else
                                <img src="https://via.placeholder.com/500" class="card-img-top" alt="Team Member Image">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $team->name }}</h5>
                            <p class="card-text">{{ $team->position }}</p>
                            <p class="card-text">{{ $team->phone_no }}</p>
                            <p class="card-text">{{ $team->email }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection