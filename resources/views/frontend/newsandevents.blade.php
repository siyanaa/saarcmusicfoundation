@extends('frontend.layouts.master')

@section('content')

<!-- Herosection -->
<section class="herosectionforallpage my-4">
    {{-- <div class="container">
        <img src="{{ asset('path/to/your/newsandevents.jpg') }}" alt="News and Events"> <!-- Update the image path accordingly -->
        <div class="d-flex flex-column innercontent">
            <span class="maintitle">News & Events</span>
            <span class="navigatetitle py-2 px-3 mb-1">
                <a href="{{ route('index') }}" style="color: white !important; text-decoration: none;">Home</a> > <span>News & Events</span>
            </span>
        </div> --}}
    </div>
</section>

<div class="">
    <h1 class="page_title">News & Events</h1>
</div>

<section class="multi_post">
    <div class="container">
        <div class="multi_poster row justify-content-center row-gap-5 gap-5">
            @foreach ($newsEvents as $newsEvent)
                <div class="card col-lg-3">
                    <a href="{{ route('SingleNewsandEvents', ['slug' => $newsEvent->slug]) }}">
                        <div class="multi_post_image">
                            @if ($newsEvent->image)
                                <img src="{{ asset('uploads/newsandevents/' . $newsEvent->image) }}"
                                    class="card-img-top" alt="News and Event Image">
                            @else
                                <img src="https://via.placeholder.com/500"
                                    class="card-img-top" alt="News and Event Image">
                            @endif
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $newsEvent->title }}</h5>
                        
                            <p class="card-text pb-4">
                                {{ Str::limit(strip_tags($newsEvent->content), 250) }}
                            </p>
                            <a href="{{ route('SingleNewsandEvents', ['slug' => $newsEvent->slug]) }}">
                                <button class="btn text-white">{{ trans('ReadMore') }} &nbsp;&nbsp;<i class="fa-solid fa-arrow-right"></i></button>
                            </a>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
