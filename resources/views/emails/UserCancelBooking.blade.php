Dear {{ $UserCancelBooking->name }},
<p>Kindly be informed, your request has been cancel. Kindly contact admin department for more information.</p> 

Customer name   : {{ $UserCancelBooking->name }}<br>
Date            : {{ \Carbon\Carbon::parse($UserCancelBooking->start_date)->format('d/m/Y') }}<br> 
Admin remarks  : {{ $UserCancelBooking->remark_approval }}<br><br>
<i>***This is an auto generated email. Please do not reply to this email. ***</i>
