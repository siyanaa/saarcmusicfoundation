@extends('frontend.layouts.master')

@section('content')
    <section class="banner">
        <div class="container-fluid">
            <div class="row g-4 align-items-center">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($coverImages as $key => $coverImage)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="2000">
                                <img src="{{ asset('uploads/coverimage/' . $coverImage->image) }}" class="d-block banners-imgs" width="100%" height="550px" alt="Cover Image" />
                                <div class="carousel-caption d-md-block">
                                    <h1 class="herosectiontitle">
                                        {{ $coverImage->title }}
                                    </h1>
                                    <a href="{{ route('About') }}"><button class="btn">READ MORE</button></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--<section class="country py-4">-->
    <!--    <div class="container swiper p-4">-->
    <!--        <div class="slide-container">-->
    <!--            <div class="card-wrapper swiper-wrapper">-->
    <!--                @foreach ($demands as $demand)-->
    <!--                    <div class="card swiper-slide text-center d-flex flex-column">-->
    <!--                        <a href="{{ route('SingleDemand', ['id' => $demand->id]) }}" class="flex-grow-1 d-flex flex-column">-->
    <!--                            <div class="img-box">-->
    <!--                                <img src="{{ asset('uploads/demands/' . $demand->image) }}" alt="" />-->
    <!--                            </div>-->
    <!--                            <div class="profile-details flex-grow-1">-->
    <!--                                <h3 class="pb-2">-->
    <!--                                    <span>{{ $demand->country->name }}</span>-->
    <!--                                </h3>-->
    <!--                                <h6>-->
    <!--                                    {{ $demand->from_date }} <span class="to">to</span> {{ $demand->to_date }} <br />-->
    <!--                                </h6>-->
    <!--                                <span class="my-1">{{ $demand->vacancy }}</span>-->
    <!--                            </div>-->
    <!--                        </a>-->
    <!--                        <div class="apply-button mt-2">-->
    <!--                            <a href="{{ route('apply', ['id' => $demand->id]) }}" class="apply-btn">Apply now</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                @endforeach-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <section class="about-us">
        <div class="container-box">
          <div class="content">
            <div class="right-box col-12">
              <h2 class="section_title">{{ $about->title ?? 'Default Title' }}</h2>
              <p>{{ $about->description ?? 'Default Description' }}</p>
              <a href="{{ route('About') }}" class="btn">Read More<i class="fa-solid fa-arrow-right mx-2"></i></a>
            </div>
          </div>
        </div>
      </section>
    

   <section class="experience ">
    <div class="container w-90 justify-content-center">
        <h2 class="text-center section_title">Objectives</h2>
        <div class="row py-4 g-2">
            @foreach ($services as $service)
                <div class="col-lg-3 col-md-3 Ebox-wrap"> 
                    <a href="{{ route('SingleService', ['slug' => $service->slug]) }}">
                        <div class="Ebox1 p-3 d-flex flex-column experiencebox">
                            {{-- <img src="{{ asset('uploads/service/' . $service->image) }}" alt="{{ $service->title }}" class="img-fluid overlay-img"><br> --}}
                            <div class="Ebox-text text-center">
                                <h6>{{ $service->title }}</h6>
                                {{-- <p>{!! Str::limit($service->description, 100) !!}</p> --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <!-- New Team Members Section -->
    <section class="team-members">
        <div class="container">
            <h2 class="text-center section_title">Executive Team</h2>
    
            @if($executiveTeam->isNotEmpty())
                <section class="multi_post">
                    
                        <div class="multi_poster row justify-content-center row-gap-5 gap-5">
                            @foreach($executiveTeam as $member)
                                <div class="card col-lg-3">
                                    <a href="{{ route('Team', ['type' => 'executive']) }}" class="stretched-link">
                                    <div class="multi_post_image">
                                        @if($member->image)
                                            <img src="{{ asset('uploads/team/' . $member->image) }}" class="card-img-top" alt="{{ $member->name }}">
                                        @else
                                            <img src="https://via.placeholder.com/500" class="card-img-top" alt="Team Member Image">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $member->name }}</h5>
                                        <p class="card-text"><b>{{ $member->position }}</b><br>
                                        {{ $member->phone_no ?? 'N/A' }}
                                        <br>{{ $member->email ?? 'N/A' }}</p>
                                    </div>
                                </a>
                                </div>
                            @endforeach
                        </div>
                    
                </section>
            @else
                <p class="alert alert-warning">No Executive Team members found.</p>
            @endif
    
            @if($advisoryTeam->isNotEmpty())
            <h2 class="text-center section_title pb-3">Advisory Team</h2>
                <section class="multi_post">
                    <div class="container">
                        <div class="multi_poster row justify-content-center row-gap-5 gap-5">
                            @foreach($advisoryTeam as $member)
                                <div class="card col-lg-3">
                                    <a href="{{ route('Team', ['type' => 'advisory']) }}" class="stretched-link">
                                    <div class="multi_post_image">
                                        @if($member->image)
                                            <img src="{{ asset('uploads/team/' . $member->image) }}" class="card-img-top" alt="{{ $member->name }}">
                                        @else
                                            <img src="https://via.placeholder.com/500" class="card-img-top" alt="Team Member Image">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $member->name }}</h5>
                                        <p class="card-text"><b>{{ $member->position }}</b>
                                        <br>
                                        {{ $member->phone_no ?? 'N/A' }}
                                        <br>{{ $member->email ?? 'N/A' }}</p>
                                    </div>
                                </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @else
                <p class="alert alert-warning">No Advisory Team members found.</p>
            @endif
    
            @if($otherTeam->isNotEmpty())
            <h2 class="text-center section_title pb-3">Other Members</h2>
                <section class="multi_post">
                    <div class="container">
                        <div class="multi_poster row justify-content-center row-gap-5 gap-5">
                            @foreach($otherTeam as $member)
                                <div class="card col-lg-3">
                                    <a href="{{ route('Team', ['type' => 'others']) }}" class="stretched-link">
                                    <div class="multi_post_image">
                                        @if($member->image)
                                            <img src="{{ asset('uploads/team/' . $member->image) }}" class="card-img-top" alt="{{ $member->name }}">
                                        @else
                                            <img src="https://via.placeholder.com/500" class="card-img-top" alt="Team Member Image">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $member->name }}</h5>
                                        <p class="card-text">{{ $member->position }}</p>
                                        <p class="card-text">{{ $member->phone_no ?? 'N/A' }}</p>
                                        <p class="card-text">{{ $member->email ?? 'N/A' }}</p>
                                    </div>
                                </a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>
            @else
                {{-- <p class="alert alert-warning">No Other Team members found.</p> --}}
            @endif
        </div>
    </section>
    
    
    {{-- <section class="blogs py-5">
        <div class="container">
            <h2 class="text-center section_title pb-3">News And Events</h2>
            <div class="row g-4">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-4">
                        <a href="{{ route('SingleBlogpostcategory', ['slug' => $blog->slug]) }}">
                            <div class="Ebox1">
                                <div class="E-B-img">
                                    <img src="{{ asset('uploads/blogpostcategory/' . $blog->image) }}" alt="">
                                </div>
                                <h3 class="text-center pt-3">{{ $blog->title }}</h3>
                                {{-- <p class="text-center pt-2">{!! $blog->content !!}</p> --}}
                            {{-- </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}} 

    <section class="multi_post">
        <div class="container">
            <h2 class="text-center section_title pb-3">News And Events</h2>
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

    

    <!--<section class="ceomessage py-3">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            @if(isset($message) && $message)-->
    <!--                <div class="col-md-7">-->
    <!--                    @if($message->image)-->
    <!--                        <img src="{{ asset('uploads/message/' . $message->image) }}" alt="{{ $message->title }}" class="img-fluid">-->
    <!--                    @else-->
    <!--                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image" class="img-fluid">-->
    <!--                    @endif-->
    <!--                </div>-->
    <!--                <div class="col-md-5">-->
    <!--                    <div class="m-box py-2 animated-image">-->
    <!--                        <h1 class="ceopositionmes">CEO MESSAGE</h1>-->
    <!--                        <p class="text-justify">{{ $message->title }}</p>-->
    <!--                        <p class="text-justify">{!! $message->description !!}</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            @else-->
    <!--                <div class="col-md-12">-->
                       
    <!--                </div>-->
    <!--            @endif-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
{{-- 
    <section class="testimonial">
        <div class="container swiper mySwiper">
            <h2 class="text-center section_title pb-3">Testimonials</h2>
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide px-5">
                        <a href="{{ route('Testimonial') }}">
                            <h5 class="text-center pt-3">{{ $testimonial->description }}</h5>
                            <div class="text-center text-img">
                                <img src="{{ asset('uploads/testimonial/' . $testimonial->image) }}" alt="Testimonial Image" style="width: 100px;">
                                <h3>{{ $testimonial->name }}</h3>
                                <h5>{{ $testimonial->company->title }}</h5>
                                <h6>{{ $testimonial->work_category ? $testimonial->work_category->title : 'Default Title' }}</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next arrow"></div>
            <div class="swiper-button-prev arrow"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section> --}}

    <section class="photo-gallery py-2">
        <div class="container">
            <h2 class="text-center section_title pb-3">Photo Gallery</h2>
            <div class="row g-4">
                @foreach ($images as $image)
                    <div class="col-lg-4 col-md-4 col-sm-6 mt-3 mb-3">
                        <div class="accordion">
                          
                            <ul>
                                @if(!empty($image->img))
                                    @foreach ($image->img as $imgUrl)
                                        <li tabindex="{{ $loop->iteration }}" style="background-image: url('{{ asset($imgUrl) }}');">
                                            <a href="{{ route('singleImage', ['slug' => $image->slug]) }}" class="d-block" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0;"></a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="accordion-content">
                                <h3 class="text-center pt-3">
                                    
                                        {{ $image->title }}
                                   
                                </h3>
                                <p class="text-center pt-2">{{ $image->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Video Gallery Section -->
    <section class="video-gallery py-3">
        <div class="container">
            <h2 class="text-center section_title pb-3">Video Gallery</h2>
            <div class="row g-4">
                @foreach ($videos as $video)
                <div class="col-md-4">
                    <div class="card video_card mt-2 mb-2">
                       <iframe width="355" height="315" src="{{ $video->url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        <div class="card-body text-center">
                            <span class="vid_desc">
                                <p class="card-text">{{ $video->title }}</p>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    <section class="blogs">
        <div class="container">
            <h2 class="text-center section_title pb-3">Blogs</h2>
            <div class="row g-4">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-4">
                        <a href="{{ route('SingleBlogpostcategory', ['slug' => $blog->slug]) }}">
                            <div class="Ebox1">
                                <div class="E-B-img">
                                    <img src="{{ asset('uploads/blogpostcategory/' . $blog->image) }}" alt="">
                                </div>
                                <h3 class="text-center pt-3">{{ $blog->title }}</h3>
                                {{-- <p class="text-center pt-2">{!! $blog->content !!}</p> --}}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!--Contact!-->


    <section class="container">
        <h1 class="text-center section_title pb-3">Contact</h1>
        <div class="d-flex flex-column justify-content-center my-5 row customconnectwithus">
            <span class="d-flex flex-column justify-content-center align-items-center containertitle">
                <!-- You can add a title or any content here if needed -->
            </span>
            <div class="d-flex flex-column justify-content-center row">
                <div class="customconnectwithus-innersection d-flex justify-content-between">
                    <div class="customconnectwithus-innersection-left col-md-5">
                        <form id="contactForm" class="form-horizontal" method="POST" action="{{ route('Contact.store') }}">
                            @csrf
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="NAME" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <input type="tel" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" placeholder="Phone No." name="phone_no" value="{{ old('phone_no') }}" required>
                                @error('phone_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <textarea class="form-control message-box @error('message') is-invalid @enderror" rows="4" placeholder="MESSAGE" name="message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column my-1">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="customconnectwithus-innersection-right-map col-md-6">
                        <div class="py-2">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.0113295175297!2d85.33579181506206!3d27.688565432806747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19954f2e09ab%3A0x7d94d308d87f4fa1!2sShantibinayak%20Marg%2C%20Kathmandu%2044600%2C%20Nepal!5e0!3m2!1sen!2snp!4v1627814296632!5m2!1sen!2snp"
                                width="100%"
                                height="400"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Existing scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var formData = new FormData(this);
                var recaptchaResponse = grecaptcha.getResponse();

                if (recaptchaResponse.length === 0) {
                    alert("Please tick the reCAPTCHA box before submitting.");
                    return;
                }

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Assuming the server returns JSON with 'success' and 'message'
                        if (response.success) {
                            alert("Message sent successfully!");
                        } else {
                            alert("Error in sending message. Please try again.");
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An unexpected error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
@endsection



