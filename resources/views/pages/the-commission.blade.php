@extends('layouts.app')

@section('content')
<div class="commission-page">
    <div class="bpsc-banner">
        <h1>The Commission</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>The Commission</span>
        </p>
    </div>

    <div class="commission-content">
        <!-- Chairman Card -->
        <div class="commission-chairman-card">
            <div class="commission-photo-wrap">
                <img src="/Chairman-rjmfzap8gaziccqhw6sd06upzqiu7bocb0wsghvs0m.jpeg" alt="Chairman" class="commission-photo commission-photo--lg">
            </div>
            <h2 class="commission-name">Shri. Parmar Ravi Manubhai</h2>
            <p class="commission-designation">Hon'ble Chairman</p>
            <p class="commission-location">BPSC, Patna</p>
        </div>

        <!-- Members Grid -->
        <h3 class="bpsc-section-title" style="margin-top: 20px; border-bottom: none; border-left: 5px solid #0aa4db; padding-left: 15px;">Hon'ble Members</h3>
        <div class="commission-members-grid">
            @php
                $members = [
                    ['name' => 'Prof. Deepti Kumari', 'photo' => '/member-deepti-kumari.png'],
                    ['name' => 'Dr. Arun Kumar Bhagat', 'photo' => '/member-arun-bhagat.png'],
                    ['name' => 'Shri Pankaj Kumar', 'photo' => '/member-pankaj-kumar.png'],
                    ['name' => 'Shri Nishith Verma', 'photo' => '/member-nishith-verma.png'],
                    ['name' => 'Shri Murli Prasad Singh', 'photo' => '/member-murli-prasad.png'],
                ];
            @endphp
            @foreach($members as $m)
                <div class="commission-member-card">
                    <div class="commission-photo-wrap">
                        <img src="{{ $m['photo'] }}" alt="{{ $m['name'] }}" class="commission-photo">
                    </div>
                    <h4 class="commission-name">{{ $m['name'] }}</h4>
                    <p class="commission-designation">Hon'ble Member</p>
                    <p class="commission-location">BPSC, Patna</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
