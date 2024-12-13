@extends('frontend.layouts.master')

@section('content')
<!-- herosection -->
<section class="aboutherosection">
    <div class="container py-5">
        <div class="row align-items-center mx-5">
            <div class="col-md-7 order-md-1 order-2">
                <h3 class="text-center pt-4">What We Give?</h3>
                <p style="text-align: justify; line-height: 1.6;">
                    {!! $about && $about->content ? $about->content : 'Content not available' !!}
                </p>
            </div>
            <div class="col-md-5 order-md-2 order-1">
                <img src="{{ $about && $about->image ? asset('uploads/about/' . $about->image) : asset('images/default.jpg') }}" alt="" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</section>


@endsection
