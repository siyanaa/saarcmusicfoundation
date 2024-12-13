{{-- @extends('frontend.includes.navbar') --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Include jQuery -->


<body>
    <section class="container">
        <h1 class="page_title">Contact</h1>
        <div class="d-flex flex-column justify-content-center my-5 row customconnectwithus">
            <span class="d-flex flex-column justify-content-center align-items-center containertitle">
                
            </span>
            <div class="d-flex flex-column justify-content-center  row">
                

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
                            {{-- <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="EMAIL" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
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
                            {{-- <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div> --}}
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column my-1">
                                <button class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                    
                        
                        {{-- Google Maps iframe --}}
                        <div class="customconnectwithus-innersection-right-map col-md-6">
                            
                            <div class="py-2">
                                    <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.0113295175297!2d85.33579181506206!3d27.688565432806747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19954f2e09ab%3A0x7d94d308d87f4fa1!2sShantibinayak%20Marg%2C%20Kathmandu%2044600%2C%20Nepal!5e0!3m2!1sen!2snp!4v1627814296632!5m2!1sen!2snp"
                                    width="100%"
                                    height="400"
                                    style="border:12;"
                                    allowfullscreen=""
                                    loading="lazy"
                                ></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 

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
</body>
</html>
