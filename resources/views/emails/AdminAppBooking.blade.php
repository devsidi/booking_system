Dear {{ $AdminAppBooking->name }},
<p>Kindly be informed, your car request has been Approved.</p> 

Customer name   : {{ $AdminAppBooking->name }}<br>
Date            : {{ \Carbon\Carbon::parse($AdminAppBooking->start_date)->format('d/m/Y') }}<br> 
Admin remarks  : {{ $AdminAppBooking->remark_approval }}<br><br>
<i>***This is an auto generated email. Please do not reply to this email. ***</i>
