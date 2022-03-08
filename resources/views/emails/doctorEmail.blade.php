Dear {{$doctorEmail['providerName']}},
<p>Congrats, You have an appointment</p>
Patient's name :{{ $doctorEmail['name'] }}<br>
Time :{{$doctorEmail['time']}}<br>
Date :{{$doctorEmail['date']}}<br>
Location : {{ $doctorEmail['Add1'] }},{{ $doctorEmail['Add2'] }},{{ $doctorEmail['Add3'] }},{{ $doctorEmail['Add4'] }},{{ $doctorEmail['Postcode'] }}<br>
Clinic's Name :{{ $doctorEmail['company_name'] }}
