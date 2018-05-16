<html>
<table>
    <tr>
        <td colspan="13"  height="20"><h4>{{ $event->name }}</h4></td>
    </tr>
    <thead>
    <tr>
        <th><strong>S. No. </strong></th>
        <th><strong>Full Name</strong></th>
        <th><strong>Registration Type</strong></th>
        <th><strong>Spouse Name</strong></th>
        <th><strong>Address</strong></th>
        <th><strong>Phone No</strong></th>
        <th><strong>Mobile No</strong></th>
        <th><strong>Email</strong></th>
        <th><strong>Organization </strong></th>
        <th><strong>Designation</strong></th>
        <th><strong>Payment Status </strong></th>
        <th><strong>Receipt/Remarks </strong></th>
        <th><strong>Registered At</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($participants as $index => $participant)
        <tr>
            <td align="right">{{ $index+1 }}</td>
            <td> {{$participant->salutation.' '.$participant->first_name.' '.$participant->middle_name.' '.$participant->last_name }} </td>
            <td> {{($participant->eventRegistrationType) ? $participant->eventRegistrationType->name : ""}} </td>
            <td> {{ $participant->spouse_name }} </td>
            <td align="right"> {{$participant->address}} </td>
            <td align="right"> {{$participant->phone_no}} </td>
            <td align="right"> {{$participant->mobile_no}} </td>
            <td align="right"> {{$participant->email}} </td>
            <td align="right"> {{$participant->organization}} </td>
            <td align="right"> {{$participant->designation}} </td>
            <td align="right">
                @if($participant->payment_status== "1")
                    Paid
                @elseif($participant->payment_status== "2")
                    Credit
                @endif
            </td>
            <td align="right">
                @if($participant->payment_status== "1")
                    {{ $participant->receipt_no }}
                @elseif($participant->payment_status== "2")
                    {{ $participant->remarks }}
                @endif
            </td>
            <td align="right"> {{$participant->created_at}} </td>
        </tr>
    @endforeach
    </tbody>
</table>

</html>