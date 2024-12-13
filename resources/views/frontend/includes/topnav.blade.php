{{-- <section class="topheader">
    <div class="container">

        <div class="row">
            <div class="col-md-6 text-left col-sm-12">

                <div class="social-buttons">
                    <a href="{{ $sitesetting->facebook_link ?? '#' }}"
                        class="social-buttons__button social-button social-button--facebook" aria-label="Facebook">
                        <span class="social-button__inner">
                            <i class="fab fa-facebook-f"></i>
                        </span>
                    </a>
                    <a href="{{ $sitesetting->linkedin_link ?? '#' }}"
                        class="social-buttons__button social-button social-button--linkedin" aria-label="LinkedIn">
                        <span class="social-button__inner">
                            <i class="fab fa-linkedin-in"></i>
                        </span>
                    </a>
                    <a href="{{ $sitesetting->instagram_link ?? '#' }}" target="_blank"
                        class="social-buttons__button social-button social-button--instagram" aria-label="Instagram">
                        <span class="social-button__inner">
                            <i class="fab fa-instagram"></i>
                        </span>
                    </a>
                </div>

            </div>

            <div class="col-md-6 col-sm-12 top_right row">
                <div class="info d-flex align-items-center col-md-4">
                    <i class="fa fa-phone mt-1 mx-1"></i> 
                    <span>
                        @if (!empty($sitesetting->office_contact))
                            @php
                                $officeContacts = json_decode($sitesetting->office_contact, true);
                            @endphp
                            @if (is_array($officeContacts))
                                @foreach ($officeContacts as $contact)
                                    {{ $contact }} <br>
                                @endforeach
                            @else
                                <span>
                                    @if (app()->getLocale() == 'ne')
                                        {{ $sitesetting->office_contact_ne ?? 'N/A' }}
                                    @else
                                        {{ $sitesetting->office_contact ?? 'N/A' }}
                                    @endif
                                </span> <br>
                            @endif
                        @endif
                    </span>
                </div>
                <div class="info d-flex align-items-center col-md-4">
                    <i class="fa-solid fa-location-dot mt-1 mx-1"></i>
                    <span>
                        @if (!empty($sitesetting->office_address))
                            @php
                                $officeAddresses = json_decode($sitesetting->office_address, true);
                            @endphp
                            @if (is_array($officeAddresses))
                                @foreach ($officeAddresses as $address)
                                    {{ $address }} <br>
                                @endforeach
                            @else
                                <span>
                                    @if (app()->getLocale() == 'ne')
                                        {{ $sitesetting->office_address_ne ?? 'N/A' }}
                                    @else
                                        {{ $sitesetting->office_address ?? 'N/A' }}
                                    @endif
                                </span> <br>
                            @endif
                        @endif
                    </span>
                </div>
                <div class="info d-flex align-items-center col-md-4">
                    <i class="fa-solid fa-envelope mt-1 mx-1"></i>
                    <span>
                        @if (!empty($sitesetting->office_email))
                            @php
                                $officeEmails = json_decode($sitesetting->office_email, true);
                            @endphp
                            @if (is_array($officeEmails))
                                @foreach ($officeEmails as $email)
                                    {{ $email }} <br>
                                @endforeach
                            @else
                                <span>
                                    @if (app()->getLocale() == 'ne')
                                        {{ $sitesetting->office_email_ne ?? 'N/A' }}
                                    @else
                                        {{ $sitesetting->office_email ?? 'N/A' }}
                                    @endif
                                </span> <br>
                            @endif
                        @endif
                    </span>
                </div>
            </div>
            
        </div>

    </div>
</section> --}}
