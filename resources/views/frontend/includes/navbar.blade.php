<!-- Header -->
<div class="header">
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
            <!-- Logo Section -->
            <a class="navbar-brand" href="{{ route('index') }}">
                <div class="image">
                    @if (!empty($sitesetting->main_logo))
                        <img src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}" alt="Main Logo" height="50">
                    @else
                        <img src="{{ asset('image/header-image.png') }}" alt="Default Logo" height="50">
                    @endif
                    {{-- <div class="c-name">
                        <h3>
                            <span>
                                {{ $sitesetting->office_name ?? 'Default Office Name' }}
                            </span>
                        </h3>
                    </div> --}}
                    {{-- <div class="slogon">
                        <h6>{{ $sitesetting->slogan ?? 'Default Slogan' }}</h6>
                    </div> --}}
                </div>
            </a>

            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Section -->
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ms-auto navbar-nav-scroll" style="--bs-scroll-height: 500px;">
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('index') }}">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Introduction
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('About') }}">About Us</a></li>
                            {{-- <li><a class="dropdown-item" href="{{ route('Team') }}">Our Teams</a></li> --}}
                            <li><a class="dropdown-item" href="{{ route('Service') }}">Objectives</a></li>
                        </ul>
                    </li>

                    <!--<li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('Demand') }}">Demands</a>
                    </li>-->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Teams
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('Team', ['type' => 'executive']) }}">Executive Team</a></li>
                            <li><a class="dropdown-item" href="{{ route('Team', ['type' => 'advisory']) }}">Advisory Team</a></li>
                            <li><a class="dropdown-item" href="{{ route('Team', ['type' => 'others']) }}">Others</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('NewsandEvents') }}">News and Events</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gallery
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('Gallery') }}">Images</a></li>
                            <li><a class="dropdown-item" href="{{ route('Video') }}">Videos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('Blogpostcategory') }}">Blogs</a>
                    </li>
                    
                    <!--<li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('Testimonial') }}">Testimonial</a>
                    </li>-->

                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('Contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

{{-- Highlight the active/current (pressed) button --}}
<script>
    const navLinks = document.querySelectorAll('.nav-link');
    const currentURL = window.location.href.split('#')[0];
    navLinks.forEach(link => {
        if (link.nextElementSibling && link.nextElementSibling.classList.contains('dropdown-menu')) {
            const subLinks = link.nextElementSibling.querySelectorAll('.dropdown-item');
            subLinks.forEach(subLink => {
                if (subLink.href && subLink.href.split('#')[0] === currentURL) {
                    link.classList.add('active');
                    subLink.classList.add('active');
                    return;
                }
            });
        } else {
            if (link.href && link.href.split('#')[0] === currentURL) {
                link.classList.add('active');
            }
        }
        link.addEventListener('click', () => {
            navLinks.forEach(otherLink => otherLink.classList.remove('active'));
            link.classList.add('active');
        });
    });

    window.addEventListener('scroll', function() {
        var scrollY = window.scrollY;
        var threshold = 0; // Adjust this value as needed
        var header = document.querySelector('.header');

        if (scrollY > threshold) {
            header.classList.add('nav-small');
            header.classList.add('sticky');
        } else {
            header.classList.remove('nav-small');
            header.classList.remove('sticky');
        }
    });
</script>