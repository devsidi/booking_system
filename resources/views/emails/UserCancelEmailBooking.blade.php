Dear {{ $UserCancelEmailBooking -> name}},
<p>Your booking updated to cancelled. Notification has been to Admin Department</p> 
Booking details. <br>
Date : {{ \Carbon\Carbon::parse($UserCancelEmailBooking->start_date)->format('d/m/Y') }}<br>
Time : {{ \Carbon\Carbon::parse($UserCancelEmailBooking->start_time)->format('h:i') }}<br><br>

<i>***This is an auto generated email. Please do not reply to this email. ***</i>
