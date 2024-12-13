@extends('frontend.layouts.master')

@section('content')
    <section class="singlepagenewsandevent">
        <div class="container">
            <h2 class="page_title">{{ $newsEvent->title }}</h2>
            
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 order-1 order-md-1">
                    <img class="sample_page_image"
                         src="{{ asset('uploads/newsandevents/' . $newsEvent->image) }}" alt="News and Event Image">
                         
                    <div class="sample_page_content">
                        {!! $newsEvent->content !!}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 order-2 order-md-2 sample_page_list mt-2 mb-2 p-4">
                    <h3>News & Events</h3><br>
                    <ul>
                        @foreach ($relatedNewsEvents as $relatedNewsEvent)
                            <li>
                                <a href="{{ route('SingleNewsandEvents', ['slug' => $relatedNewsEvent->slug]) }}">
                                    {{ $relatedNewsEvent->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
