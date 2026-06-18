@extends('layouts.app')

@section('content')
<div class="bpsc-inner-page">
    <div class="bpsc-banner">
        <h1>Contact Us</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>Contact Us</span>
        </p>
    </div>

    <div class="bpsc-content">
        <div class="cu-details-card">
            <h3 class="cu-details-title">Contact Details</h3>
            <ul class="cu-details-list">
                <li><span class="cu-icon">📍</span> <span><strong>BIHAR PUBLIC SERVICE COMMISSION</strong><br>15, Nehru Path (Bailey Road), Patna – 800001 (Bihar)</span></li>
                <li><span class="cu-icon">📞</span> <span><strong>Enquiry Section :</strong> 0612-2237999, 89864-22296</span></li>
                <li><span class="cu-icon">📱</span> <span><strong>IT Section For Online Application :</strong> 9297739013, 8235422867, 8235422948</span></li>
                <li><span class="cu-icon">✉️</span> <span><strong>Email :</strong> <a href="mailto:bpscpat-bih@nic.in" style="color: #0aa4db;">bpscpat-bih@nic.in</a></span></li>
            </ul>
        </div>

        <h2 class="bpsc-section-title">Administration</h2>
        <div class="bpsc-table-wrapper">
            <table class="bpsc-data-table">
                <thead>
                    <tr>
                        <th>SR. NO.</th>
                        <th>NAME</th>
                        <th>DESIGNATION</th>
                        <th>OFFICE NUMBERS</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $admin = [
                            ['sr' => 1, 'name' => 'Shri Satya Prakash Sharma', 'desig' => 'Secretary', 'num' => '0612-2215187'],
                            ['sr' => 2, 'name' => 'Shri Himanshu Kumar', 'desig' => 'Planing Officer', 'num' => ''],
                            ['sr' => 3, 'name' => 'Shri Rajesh Kumar Singh', 'desig' => 'Examination Controller', 'num' => ''],
                            ['sr' => 4, 'name' => 'Shri Kundan Kumar', 'desig' => 'Joint Secretary', 'num' => ''],
                            ['sr' => 5, 'name' => 'Shri Amitav Sinha', 'desig' => 'Joint Secretary', 'num' => ''],
                        ];
                    @endphp
                    @foreach($admin as $row)
                        <tr>
                            <td>{{ $row['sr'] }}</td>
                            <td>{{ $row['name'] }}</td>
                            <td>{{ $row['desig'] }}</td>
                            <td>{{ $row['num'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Google Map -->
        <div style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; margin-top: 30px;">
            <iframe title="BPSC Location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3597.5501865243033!2d85.11181827457782!3d25.61986427743907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ed582debed8945%3A0xc6cb5da3edfaef52!2sBihar%20Public%20Service%20Commission!5e0!3m2!1sen!2sin!4v1715694857475!5m2!1sen!2sin" width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
@endsection
