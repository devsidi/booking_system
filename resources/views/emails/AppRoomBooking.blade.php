Dear {{ $AppRoomBooking->name }},
<p>Kindly be informed, your Room Meeting request has been Approved.</p> 

Customer name   : {{ $AppRoomBooking->name }}<br>
Date            : {{ \Carbon\Carbon::parse($AppRoomBooking->start_date)->format('d/m/Y') }}<br> 
Admin remarks  : {{ $AppRoomBooking->remark_approval }}<br><br>
<i>***This is an auto generated email. Please do not reply to this email. ***</i>