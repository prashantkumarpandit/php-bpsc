@extends('layouts.app')

@section('content')
<div class="section-page">
    <div class="bpsc-banner">
        <h1>Section</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>Section</span>
        </p>
    </div>

    <div class="section-content">

        <h2 class="section-heading-blue">The Mandate of Bihar Public Service Commission</h2>
        <p class="section-para">
            Article 320 and 321 of the Constitution of India prescribes the mandate of the State Public
            Service Commissions, which is
        </p>
        <ul class="section-icon-list">
            @php
                $mandates = [
                    'Recruitment by conduct of Competitive Examinations/ through interviews to the services of the State Government.',
                    'Advising the State Government on the suitability of officers on appointment on promotion as well as transfer from one service to the other.',
                    'Advising the State Government on the matters related with recruitment to various services and posts, framing and amendment of recruitment Rules.',
                    'Advising the State Government in the matter of grant of extraordinary pension, reimbursement of legal expenses, etc.',
                    'Advising the State Government on any matter referred to the Commission by the Governor of Bihar.',
                ];
            @endphp
            @foreach($mandates as $item)
                <li><span class="arrow-icon">↺</span> {{ $item }}</li>
            @endforeach
        </ul>

        <h2 class="section-heading-blue">Recruitment:</h2>
        <p class="section-para">Recruitment is made by two methods –</p>
        <ol class="section-ordered-list" style="padding-left: 20px;">
            <li style="margin-bottom: 15px;">
                <strong class="highlight-blue">Direct Recruitment</strong> – Direct recruitment is
                made mainly by way of conducting competitive examination in which the selection is done
                on the basis of either of the following procedures:
                <ol class="section-sub-list" type="A" style="padding-left: 20px; margin-top: 10px;">
                    <li>Main (Written) Examination and Interview of the successful candidates of the Preliminary Test prescribed under rules.</li>
                    <li>Written Examination and Interview.</li>
                    <li>Interview.</li>
                </ol>
            </li>
            <li>
                <strong class="highlight-blue">Promotion</strong> – Promotion is granted to civil
                servants through the Departmental Promotion Committee (under the chairmanship of the
                Commission) constituted for the same and in accordance with the rules framed by the
                State Government.
            </li>
        </ol>

        <h2 class="section-heading-blue">Annual Report</h2>
        <p class="section-para">
            Article 323 of the Constitution of India prescribes for the submission of annual report of
            the work done by the State Public Service Commission to the Governor of the State. The Bihar
            Public Service Commission accordingly submits annual report of the work done by the
            Commission to the Governor of Bihar.
        </p>

        <div class="section-bold-block">
            On the requisition by different departments of Government of Bihar, in the process of
            recruitment/ recommendation different types of works are done in BPSC by different Sections.
        </div>

        <ul class="section-icon-list">
            @php
                $sections = [
                    'Establishment Section', 'Issue Section', 'Account Section', 'Budget Section', 'Enquiry Section',
                    'Record Section', 'Legal Section', 'Vehicles and Telephone (Caretaker) Section',
                    'Public Information (RTI) Section', 'Purchase Section', 'Advertisement Section',
                    'e-Governance (IT) Section', 'Examination Section (7A, 7B, 7C, 5A, 5B)',
                    'Confidential Section (6A)', 'Recommendation Section (6B)', 'Interview Section – 6C',
                    'Coding, Evaluation, Scrutiny (6D) Section', 'Answer sheet-cum-strong Room- 6E',
                    'Scanning, Onscreen evaluation Section – 6F', 'Computer Section', 'Statistics Section',
                    'Promotion Section', 'Unused Answer Sheet/OMR Section'
                ];
            @endphp
            @foreach($sections as $sec)
                <li><span class="arrow-icon">↺</span> {{ $sec }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
