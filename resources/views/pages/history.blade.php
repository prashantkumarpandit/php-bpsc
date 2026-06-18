@extends('layouts.app')

@section('content')
<div class="history-page">
    <div class="history-banner">
        <h1>History</h1>
        <p class="history-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>History</span>
        </p>
    </div>

    <div class="history-content">
        <h2 class="history-section-title">Brief History and Constitution:</h2>

        <p>
            The history of Constitution of India reveals that the concept of conducting competitive examination
            for appointment to certain posts came into consideration way back in the year 1853 and a committee
            for giving shape to that was constituted under the chairmanship of Lord Macaulay in the year 1854.
            Later on the Federal Public Service Commission and the State Public Service Commissions were
            constituted under the Government of India Act, 1935.
        </p>

        <p>
            The Bihar Public Service Commission came into existence from 1st April 1949 after its separation
            from the Commission for the States of Orissa and Madhya Pradesh, in accordance with sub-section (1)
            of section 261 of the Government of India Act, 1935, as adapted. Its constitutional status was
            pronounced with the promulgation of Constitution of India on 26th January, 1950. It is a
            Constitutional Body under Article 315 of the Constitution of India.
        </p>

        <p>
            The Bihar Public Service Commission initially began its functioning for the State of Bihar with its
            headquarters at Ranchi. The State Government decided to shift the headquarters of the Commission
            from Ranchi to Patna and it was finally shifted to Patna on 1st March 1951.
        </p>

        <p>
            The first Chairman of the Bihar Public Service Commission was Shri Rajandhari Sinha. Shri Radha
            Krishna Choudhary was the first Secretary to the Commission. The present Head Quarter of the
            Commission is located at 15, Nehru Path (Bailey Road), Patna – 800001.
        </p>

        <h2 class="history-table-title">List of Chairmen of Bihar Public Service Commission</h2>

        <div class="history-table-wrapper">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>SR. NO.</th>
                        <th>NAME</th>
                        <th>DATE FROM</th>
                        <th>DATE TO</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $chairmen = [
                            ['sr' => 1, 'name' => 'Sri Rajandhari Sinha', 'from' => '01/04/1949', 'to' => '31/03/1953'],
                            ['sr' => 2, 'name' => 'Dr. Amarnath Jha', 'from' => '01/04/1953', 'to' => '01/09/1955'],
                            ['sr' => 3, 'name' => 'Sri Bhagwat Prasad', 'from' => '02/09/1955', 'to' => '02/09/1955'],
                            ['sr' => 4, 'name' => 'Sri K.S.V. Raman', 'from' => '03/09/1956', 'to' => '31/05/1962'],
                            ['sr' => 5, 'name' => 'Sri B. N. Rohtagi', 'from' => '13/06/1962', 'to' => '15/01/1968'],
                            ['sr' => 6, 'name' => 'Sri Jagat Nandan Sahay', 'from' => '22/02/1968', 'to' => '30/06/1972'],
                            ['sr' => 7, 'name' => 'Dr. H. N. Yadav', 'from' => '01/07/1972', 'to' => '01/02/1973'],
                            ['sr' => 8, 'name' => 'Dr. Ramawatar Shukla', 'from' => '02/02/1973', 'to' => '01/02/1979'],
                            ['sr' => 9, 'name' => 'Dr. Kumar Vimal', 'from' => '09/02/1979', 'to' => '08/02/1985'],
                            ['sr' => 10, 'name' => 'Sri A. K. M. Hasan', 'from' => '15/05/1985', 'to' => '31/08/1989'],
                            ['sr' => 11, 'name' => 'Sri S. S. Dhanoa', 'from' => '30/09/1989', 'to' => '14/10/1989'],
                            ['sr' => 12, 'name' => 'Sri Kritbhu Dev', 'from' => '15/10/1989', 'to' => '22/12/1989'],
                            ['sr' => 13, 'name' => 'Sri K. K. Srivastava', 'from' => '01/01/1990', 'to' => '07/01/1991'],
                            ['sr' => 14, 'name' => 'Dr. (Prof.) Ram Ashray Yadav', 'from' => '23/01/1991', 'to' => '22/01/1997'],
                            ['sr' => 15, 'name' => 'Dr. (Prof.) Laxmi Rai', 'from' => '25/01/1997', 'to' => '24/01/2003'],
                            ['sr' => 16, 'name' => 'Dr. (Prof.) Razia Tabassum', 'from' => '27/03/2003 (Acting)', 'to' => '29/07/2004'],
                            ['sr' => 17, 'name' => 'Dr. (Prof.) Ram Singhasan Singh', 'from' => '30/07/2004', 'to' => '30/06/2006'],
                            ['sr' => 18, 'name' => 'Sri N. K. Agrawal', 'from' => '01/03/2006 (Acting)', 'to' => '26/10/2006'],
                            ['sr' => 19, 'name' => 'Sri A. K. Choudhary', 'from' => '15/01/2008', 'to' => '02/08/2009'],
                            ['sr' => 20, 'name' => 'Sri R. J. M. Pillai', 'from' => '03/08/2009', 'to' => '15/11/2011'],
                            ['sr' => 21, 'name' => 'Sri K. C. Saha', 'from' => '16/11/2011', 'to' => '26/03/2015'],
                            ['sr' => 22, 'name' => 'Sri Alok Kumar Sinha', 'from' => '27/03/2015', 'to' => '16/04/2018'],
                            ['sr' => 23, 'name' => 'Sri Shishir Sinha', 'from' => '29/04/2018', 'to' => '19/07/2020'],
                            ['sr' => 24, 'name' => 'Sri Shobhendra Kumar Choudhary', 'from' => '23/07/2020 (Acting)', 'to' => '31/08/2020'],
                            ['sr' => 25, 'name' => 'Shri Atul Prasad', 'from' => '01/09/2020', 'to' => '31/08/2023'],
                            ['sr' => 26, 'name' => 'Shri Parmar Ravi Manubhai', 'from' => '01/09/2023', 'to' => 'Till Date'],
                        ];
                    @endphp
                    @foreach($chairmen as $idx => $row)
                        <tr class="{{ $idx % 2 === 0 ? 'row-even' : 'row-odd' }}">
                            <td>{{ $row['sr'] }}</td>
                            <td>{{ $row['name'] }}</td>
                            <td>{{ $row['from'] }}</td>
                            <td>{{ $row['to'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
