@foreach($staffs as $staff)
	<tr>
		<td>{{$staff->first_name.' '.$staff->last_name}} </td>
		<td>{{$staff->mobile}}</td>
		<td>{{$staff->email}}</td>
	</tr>
@endforeach