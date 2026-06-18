@extends('layouts.app')

@section('content')
<div class="commission-page">
    <div class="bpsc-banner">
        <h1>Community</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>Community</span>
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

        <!-- Members grid — text only -->
        <h3 class="bpsc-section-title" style="margin-top: 20px; border-bottom: none; border-left: 5px solid #0aa4db; padding-left: 15px;">Officers and Members</h3>
        <div class="community-members-grid">
            @php
                $members = [
                    ['name' => 'Prof. Deepti Kumari', 'designation' => "Hon'ble Member"],
                    ['name' => 'Dr. Arun Kumar Bhagat', 'designation' => "Hon'ble Member"],
                    ['name' => 'Shri. Pankaj Kumar', 'designation' => "Hon'ble Member"],
                    ['name' => 'Shri. Nishith Verma', 'designation' => "Hon'ble Member"],
                    ['name' => 'Shri. Murli Prasad Singh', 'designation' => "Hon'ble Member"],
                    ['name' => 'Shri. Satya Prakash Sharma', 'designation' => 'Secretary'],
                    ['name' => 'Shri. Rajesh Kumar Singh', 'designation' => 'Examination Controller'],
                    ['name' => 'Shri. Kundan Kumar', 'designation' => 'Joint Secretary'],
                    ['name' => 'Shri. Amitav Sinha', 'designation' => 'Joint Secretary'],
                    ['name' => 'Shri. Samir Kumar Sinha', 'designation' => 'Joint Secretary'],
                    ['name' => 'Smt. Anupma Kumari', 'designation' => 'Deputy Secretary'],
                    ['name' => 'Smt. Anisha Singh', 'designation' => 'Deputy Secretary'],
                    ['name' => 'Shri. Rajnish Kumar', 'designation' => 'Deputy Secretary'],
                    ['name' => 'Shri. Pradeep Kumar', 'designation' => 'Deputy Secretary'],
                    ['name' => 'Shri. Sanjay Kumar Mishra', 'designation' => 'Deputy Secretary'],
                ];
            @endphp
            @foreach($members as $m)
                <div class="community-member-card">
                    <h4 class="commission-name">{{ $m['name'] }}</h4>
                    <p class="community-desig">Designation: {{ $m['designation'] }}</p>
                    <p class="community-loc">BPSC, Patna</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
