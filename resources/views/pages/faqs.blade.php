@extends('layouts.app')

@section('content')
<div class="bpsc-inner-page">
    <div class="bpsc-banner">
        <h1>FAQs</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>FAQs</span>
        </p>
    </div>

    <div class="bpsc-content">
        <h2 class="bpsc-section-title">Frequently Asked Questions</h2>
        <p style="margin-bottom: 30px;">Find answers to commonly asked questions about BPSC examinations and processes.</p>

        <div class="faq-container">
            @php
                $faqs = [
                    ['q' => 'How can I apply for BPSC examinations?', 'a' => 'You can apply online through the official BPSC portal (onlinebpsc.bihar.gov.in) by completing the One Time Registration (OTR) and filling out the specific application form for the active advertisement.'],
                    ['q' => 'What is the syllabus for the Combined Competitive Examination?', 'a' => 'The syllabus is divided into Prelims and Mains. Prelims consist of General Studies, while Mains include General Hindi, General Studies Papers I & II, and an Essay. Detailed syllabus PDFs are available in the Syllabus section.'],
                    ['q' => 'Can I edit my application form after submission?', 'a' => 'Generally, application forms cannot be edited after final submission and fee payment. However, for certain fields like Gender in OTR, a specific edit window might be provided via an official notice.'],
                    ['q' => 'Where can I find my admit card?', 'a' => 'Admit cards are released on the official website a few weeks before the examination date. You can download it by logging into your account using your registration number and password.'],
                    ['q' => 'How is the final merit list prepared?', 'a' => 'The final merit list is usually prepared based on the marks obtained in the Main (Written) Examination and the Interview (Personality Test). Prelims marks are qualifying in nature and are not added to the final score.'],
                ];
            @endphp

            @foreach($faqs as $i => $faq)
                <div class="faq-item" id="faq-{{ $i }}">
                    <div class="faq-question" onclick="toggleFaq('faq-{{ $i }}')">
                        <span>{{ $faq['q'] }}</span>
                        <i data-lucide="chevron-down" class="faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function toggleFaq(id) {
        const item = document.getElementById(id);
        const isActive = item.classList.contains('active');
        
        // Close all
        document.querySelectorAll('.faq-item').forEach(el => {
            el.classList.remove('active');
            // Reset icons
        });

        // Open clicked if it wasn't active
        if(!isActive) {
            item.classList.add('active');
        }
    }
</script>
@endsection
