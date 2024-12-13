@extends('frontend.layouts.master')

@section('content')


    <h1 class="page_title">
        <span>
           
                {{ $image->title }}
           
        </span>
    </h1>
</div>

<section class="single_page">
    <div class="container">
        <div class="row mt-3">
            <p class="text-center"> <span>
                @if (app()->getLocale() == 'ne')
                    {{ $image->img_desc_ne }}
                @else
                    {{ $image->img_desc }}
                @endif
            </span></p>
            @foreach ($image->img as $imgUrl)
            <div class="col-md-4 mb-3">
                <a class="image-link" href="{{ asset($imgUrl) }}" style="color: var(--first)">
                    <img src="{{ asset($imgUrl) }}" class="gallery_image">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Include Magnific Popup CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include Magnific Popup JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
    $(document).ready(function(){
        $('.image-link').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
        });
    });
</script>

@endsection
