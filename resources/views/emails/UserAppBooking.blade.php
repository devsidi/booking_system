Dear {{ $UserAppBooking->name }},
<p>Your booking Has been Approved by Admin Department. Kindly contact Admin for further action.</p> 
Booking details. <br>
Customer Name   : {{ $UserAppBooking->name }}<br>
Date            : {{ \Carbon\Carbon::parse($UserAppBooking->start_date)->format('d/m/Y') }}<br> 
Durations       : {{ $UserAppBooking->duration }}<br>
Client remarks  : {{ $UserAppBooking->remarks }}<br><br>
<i>***This is an auto generated email. Please do not reply to this email. ***</i>
