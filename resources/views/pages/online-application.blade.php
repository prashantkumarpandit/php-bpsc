@extends('layouts.app')

@section('content')
<div class="bpsc-inner-page">
    <div class="bpsc-banner">
        <h1>Online Application</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span><span class="sep">»</span><span>Online Application</span>
        </p>
    </div>

    <div class="bpsc-content">
        <h2 class="bpsc-section-title">How to Apply Online</h2>
        <p>Follow the steps below to successfully submit your online application for BPSC examinations.</p>

        <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 36px;">
            @php
                $steps = [
                    ['icon' => '1', 'title' => 'Register / OTR', 'desc' => 'Create your One Time Registration (OTR) account on the official BPSC website. You need a valid mobile number and email address.'],
                    ['icon' => '2', 'title' => 'Fill Application Form', 'desc' => 'Select the advertisement and fill the application form carefully with correct personal, educational, and category details.'],
                    ['icon' => '3', 'title' => 'Upload Documents', 'desc' => 'Upload scanned copies of your photograph, signature, and required certificates in the specified format and size.'],
                    ['icon' => '4', 'title' => 'Pay Application Fee', 'desc' => 'Pay the requisite fee online via Net Banking, Debit Card, Credit Card, or UPI. Note your transaction ID.'],
                    ['icon' => '5', 'title' => 'Submit & Download', 'desc' => 'Submit the form and download the confirmation page. Keep it safe for future reference.'],
                ];
            @endphp
            @foreach($steps as $s)
                <div style="display: flex; align-items: flex-start; gap: 18px; padding: 16px 20px; background: #f0f7ff; border-radius: 10px; border: 1px solid #bfdbfe;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg,#0288d1,#00bcd4); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 18px; flex-shrink: 0;">{{ $s['icon'] }}</div>
                    <div>
                        <h4 style="color: #0d47a1; margin: 0 0 6px; font-size: 0.97rem;">{{ $s['title'] }}</h4>
                        <p style="margin: 0; font-size: 13.5px; color: #444; line-height: 1.6;">{{ $s['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="bpsc-section-title">Active Applications</h2>
        <div class="bpsc-table-wrapper">
            <table class="bpsc-data-table">
                <thead>
                    <tr>
                        <th>SR.</th>
                        <th>EXAMINATION NAME</th>
                        <th>LAST DATE</th>
                        <th>APPLICATION FEE</th>
                        <th>APPLY</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $activeExams = [
                            ['title' => '70th Combined (Preliminary) Competitive Examination, 2024', 'lastDate' => '31-03-2025', 'fee' => '₹600 (General) / ₹150 (SC/ST)', 'link' => '#'],
                            ['title' => 'Assistant Education Development Officer Examination, 2025', 'lastDate' => '15-04-2025', 'fee' => '₹600 (General) / ₹150 (SC/ST)', 'link' => '#'],
                            ['title' => 'Bihar Judicial Services (Preliminary) Examination, 2025', 'lastDate' => '20-04-2025', 'fee' => '₹1000 (General) / ₹250 (SC/ST)', 'link' => '#'],
                        ];
                    @endphp
                    @foreach($activeExams as $i => $e)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $e['title'] }} <span class="badge-new">OPEN</span></td>
                            <td style="white-space: nowrap; color: #dc2626;"><i data-lucide="clock" size="13" style="margin-right: 4px; vertical-align: middle;"></i>{{ $e['lastDate'] }}</td>
                            <td style="white-space: nowrap;">{{ $e['fee'] }}</td>
                            <td><a href="{{ $e['link'] }}" class="btn-download"><i data-lucide="external-link" size="13"></i> Apply</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bpsc-article-block">
            <h3><i data-lucide="help-circle" size="16" style="margin-right: 6px;"></i> Important Instructions</h3>
            <ul style="padding-left: 20px; line-height: 1.8; color: #444;">
                <li>Read the official advertisement carefully before applying.</li>
                <li>Ensure your details in OTR are correct as they cannot be changed later.</li>
                <li>Upload photograph and signature in JPG format (max 50KB each).</li>
                <li>Keep your transaction ID/payment receipt safe.</li>
                <li>Do not submit the form multiple times — only your last submission will be considered.</li>
                <li>For technical issues, contact the Helpdesk at 8986422296 or email bpscpat-bih@nic.in</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 24px;">
            <a href="https://onlinebpsc.bihar.gov.in" target="_blank" class="btn-download" style="font-size: 15px; padding: 12px 32px;">
                <i data-lucide="external-link" size="16"></i> Go to Online Application Portal
            </a>
        </div>
    </div>
</div>
@endsection
