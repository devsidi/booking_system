Dear {{$userBooking['name']}},
<p>Admin department will review your booking request, email notification will be sent back to you soon.</p>
Booking Name    :{{ $userBooking['providerName'] }}<br>
Time            : {{$userBooking['time']}}<br>
Date            : {{$userBooking['date']}}<br>
Remarks            : {{ $userBooking['reason'] }}<br><br>

<i>***This is an auto generated email. Please do not reply to this email. ***</i>
