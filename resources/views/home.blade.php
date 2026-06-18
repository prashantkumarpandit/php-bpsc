@extends('layouts.app')

@section('content')
<div>
    <!-- Marquee Section -->
    <div class="marquee-container">
        <div class="marquee-icon">
            <i data-lucide="lightbulb" color="white" size="20"></i>
        </div>
        <div class="marquee-content">
            <div class="marquee-text">
                <strong>Important Notice:</strong> Facility to edit GENDER in OTR (One Time Registration) &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; <strong>Important Notice:</strong> District Statistical Officer/Assistant Director Main (Written) Competitive Examination
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <!-- Image Slider -->
        <div class="hero-slider" id="hero-slider" onmouseenter="pauseSlider()" onmouseleave="startSlider()">
            <div class="slide active">
                <img src="/bpsc8.jpeg" alt="BPSC Campus" class="slider-image">
                <div class="slide-caption">Bihar Public Service Commission Main Campus</div>
            </div>
            <div class="slide">
                <img src="/biharrr-1.jpg" alt="BPSC Office" class="slider-image">
                <div class="slide-caption">BPSC Office Administration Building</div>
            </div>
            <div class="slide">
                <img src="/DSC_2639-scaled-1.jpg" alt="Examination Hall" class="slider-image">
                <div class="slide-caption">BPSC Examination Hall & Staff Office</div>
            </div>
            
            <!-- Navigation Buttons -->
            <button class="slider-btn prev" onclick="prevSlide()"><i data-lucide="chevron-left" size="32"></i></button>
            <button class="slider-btn next" onclick="nextSlide()"><i data-lucide="chevron-right" size="32"></i></button>
            
            <!-- Slide Indicators/Dots -->
            <div class="slider-dots">
                <span class="dot active" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
            </div>
        </div>

        <!-- What's New Sidebar -->
        <div class="whats-new-widget">
            <h3 class="whats-new-title">What's New</h3>
            <div class="whats-new-scroll-wrapper" onmouseenter="this.querySelector('.whats-new-track').style.animationPlayState = 'paused'" onmouseleave="this.querySelector('.whats-new-track').style.animationPlayState = 'running'">
                <div class="whats-new-track">
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Important Notice:</span><br><span class="whats-new-desc">District Statistical Officer/Assistant Director Main Examination.</span>
                    </a>
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Interview Program:</span><br><span class="whats-new-desc">Integrated 70th Combined Competitive Examination.</span>
                    </a>
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Important Notice:</span><br><span class="whats-new-desc">Date of Commencement of Interview.</span>
                    </a>
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Important Notice:</span><br><span class="whats-new-desc">Regarding Postponement of Assistant Education Officer.</span>
                    </a>
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Important Notice:</span><br><span class="whats-new-desc">Date of Commencement of Exam for Town Planner.</span>
                    </a>
                    <!-- Duplicate for seamless looping -->
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Important Notice:</span><br><span class="whats-new-desc">District Statistical Officer/Assistant Director Main Examination.</span>
                    </a>
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Interview Program:</span><br><span class="whats-new-desc">Integrated 70th Combined Competitive Examination.</span>
                    </a>
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Important Notice:</span><br><span class="whats-new-desc">Date of Commencement of Interview.</span>
                    </a>
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Important Notice:</span><br><span class="whats-new-desc">Regarding Postponement of Assistant Education Officer.</span>
                    </a>
                    <a href="#" class="whats-new-item">
                        <span class="whats-new-label">Important Notice:</span><br><span class="whats-new-desc">Date of Commencement of Exam for Town Planner.</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons Section -->
    <div class="action-buttons-container">
        <a href="{{ route('advertisements') }}" class="action-btn-card">
            <i data-lucide="megaphone" size="32" class="action-icon"></i>
            <span>Advertisements</span>
        </a>
        <a href="{{ route('online-application') }}" class="action-btn-card">
            <i data-lucide="monitor" size="32" class="action-icon"></i>
            <span>Online<br>Application</span>
        </a>
        <a href="#" class="action-btn-card">
            <i data-lucide="file-text" size="32" class="action-icon"></i>
            <span>View<br>Marksheet</span>
        </a>
        <a href="#" class="action-btn-card">
            <i data-lucide="users" size="32" class="action-icon"></i>
            <span>Interview<br>Letters</span>
        </a>
    </div>

    <!-- Announcements Section -->
    <div class="announcements-section">
        <h2 class="announcements-title">Important Announcements</h2>
        <div class="announcements-tabs">
            <button class="tab-btn active">All</button>
            <button class="tab-btn">Notices</button>
            <button class="tab-btn">Programs</button>
            <button class="tab-btn">Interviews</button>
            <button class="tab-btn">Results</button>
            <a href="{{ route('advertisements') }}" class="tab-btn" style="text-decoration: none; color: inherit; display: inline-block;">Advertisement</a>
        </div>
        <div class="announcements-table-container">
            <table class="announcements-table">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Date</th>
                        <th>Sub Category</th>
                        <th>Advertisement No.</th>
                        <th>Subject / Details</th>
                        <th>View / Download</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>27-02-2026</td>
                        <td>Corrigendum</td>
                        <td>(Advt. No. 01/2019)</td>
                        <td>Results of Assistant Engineer, Civil Competitive Examination published on 20.02.2026.</td>
                        <td><i data-lucide="download"></i></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>25-02-2026</td>
                        <td>Examination Program</td>
                        <td>(Advt. No. 87/2025)</td>
                        <td>Assistant Education Development Officer Written (Objective) Competitive Examination.</td>
                        <td><i data-lucide="download"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom 3-Column Section -->
    <div class="bottom-sections-container">
        <div class="chairman-card">
            <div class="chairman-photo-container">
                <img src="/Chairman-rjmfzap8gaziccqhw6sd06upzqiu7bocb0wsghvs0m.jpeg" alt="Chairman" class="chairman-photo">
            </div>
            <div class="chairman-details">
                <h3 class="chairman-name">Shri Parmar Ravi Manubhai</h3>
                <p class="chairman-title">(Hon'ble Chairman)</p>
                <p class="chairman-location">BPSC, Patna</p>
            </div>
        </div>

        <div class="key-contacts-card">
            <div class="card-header"><h3>Key Contacts</h3><i data-lucide="mail"></i></div>
            <div class="contact-list">
                <div class="contact-item">
                    <img src="/satyaprakas.jpeg" alt="Secretary" class="contact-photo">
                    <div class="contact-info">
                        <h4>Shri Satya Prakash Sharma, I.A.S.</h4>
                        <p>Secretary</p>
                        <a href="tel:0612-2215187" class="contact-link"><i data-lucide="phone" size="12"></i> 0612-2215187</a>
                    </div>
                </div>
                <hr class="contact-divider">
                <div class="contact-item">
                    <div class="contact-photo-placeholder">
                        <i data-lucide="phone" size="24" style="color: #00a2e8;"></i>
                    </div>
                    <div class="contact-info">
                        <h4>Enquiry Section</h4>
                        <p>BPSC Office Inquiry</p>
                        <a href="tel:0612-2237999" class="contact-link"><i data-lucide="phone" size="12"></i> 0612-2237999</a>
                    </div>
                </div>
                <div class="view-all-link">
                    <a href="{{ route('contact-us') }}">View All Contacts →</a>
                </div>
            </div>
        </div>

        <div class="app-video-card">
            <div class="card-header"><h3>Application Video</h3><i data-lucide="play-circle"></i></div>
            <div class="video-list" style="overflow-y: auto; padding: 15px; max-height: 250px;">
                <div class="video-item" style="position: relative; padding-bottom: 56.25%; height: 0; margin-bottom: 15px;">
                    <iframe src="https://www.youtube.com/embed/KhGuXg64PxM?si=P-rrdzMnhTRa3De0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 4px;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="video-item" style="position: relative; padding-bottom: 56.25%; height: 0;">
                    <iframe src="https://www.youtube.com/embed/4bZZrVzS7_c" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 4px;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Useful Links & Visitor Counter -->
    <div class="useful-links-section">
        <div class="useful-links-card">
            <h3 class="useful-links-title">Useful Links</h3>
            <div class="useful-links-grid">
                <a href="https://www.digilocker.gov.in/" target="_blank" rel="noopener noreferrer">
                    <img src="/digilocker.jpg" alt="DigiLocker" class="useful-logo">
                </a>
                <a href="https://www.upsc.gov.in/" target="_blank" rel="noopener noreferrer">
                    <img src="/upsc.jpg" alt="UPSC" class="useful-logo">
                </a>
                <a href="https://state.bihar.gov.in/" target="_blank" rel="noopener noreferrer">
                    <img src="/bihar-gov.png" alt="Bihar Sarkar" class="useful-logo">
                </a>
                <a href="https://bpsc.bih.nic.in/" target="_blank" rel="noopener noreferrer">
                    <img src="/bpsc-logo-small.png" alt="BPSC" class="useful-logo">
                </a>
                <a href="https://serviceonline.bihar.gov.in/" target="_blank" rel="noopener noreferrer">
                    <img src="/rtps.jpg" alt="RTPS Bihar" class="useful-logo">
                </a>
                <a href="https://www.nic.in/" target="_blank" rel="noopener noreferrer">
                    <img src="/nic.png" alt="NIC" class="useful-logo">
                </a>
            </div>
        </div>
        <div class="visitor-sidebar">
            <div class="visitor-counter-card">
                <div class="visitor-header">Visitor Counter</div>
                <table class="visitor-table">
                    <tbody>
                        <tr><td>Today:</td><td>{{ $stats['today'] }}</td></tr>
                        <tr><td>Yesterday:</td><td>{{ $stats['yesterday'] }}</td></tr>
                        <tr><td>This Month:</td><td>{{ $stats['thisMonth'] }}</td></tr>
                        <tr><td>This Year:</td><td>{{ $stats['thisYear'] }}</td></tr>
                        <tr><td>Total:</td><td>{{ $stats['total'] }}</td></tr>
                    </tbody>
                </table>
            </div>
            <button class="hindi-font-btn">Hindi Fonts Download</button>
        </div>
    </div>
</div>

<script>
    let slideIndex = 0;
    let slideTimer;

    function showSlides(index) {
        const slides = document.getElementsByClassName("slide");
        const dots = document.getElementsByClassName("dot");
        
        if (index >= slides.length) { slideIndex = 0; }
        else if (index < 0) { slideIndex = slides.length - 1; }
        else { slideIndex = index; }
        
        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove("active");
        }
        for (let i = 0; i < dots.length; i++) {
            dots[i].classList.remove("active");
        }
        
        if (slides[slideIndex]) slides[slideIndex].classList.add("active");
        if (dots[slideIndex]) dots[slideIndex].classList.add("active");
    }

    function nextSlide() {
        showSlides(slideIndex + 1);
    }

    function prevSlide() {
        showSlides(slideIndex - 1);
    }

    function currentSlide(index) {
        showSlides(index);
        resetTimer();
    }

    function startSlider() {
        slideTimer = setInterval(nextSlide, 5000);
    }

    function pauseSlider() {
        clearInterval(slideTimer);
    }

    function resetTimer() {
        pauseSlider();
        startSlider();
    }

    // Initialize slider
    startSlider();
</script>
@endsection
