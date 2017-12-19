@if(!$replyMessages->isEmpty())
	@foreach($replyMessages as $reply)
		<tr>
			<td>{{$reply->created_at->format('Y-m-d')}}</td>
			<td>{{$reply->created_at->format('H:i:s')}}</td>
			<td>{{$reply->to}}</td>
			<td>{{$reply->from}}</td>
			<td>{{$reply->body}}</td>
		</tr>
	@endforeach
@else
	<tr>
		<td colspan='5'>No reply found</td>
	</tr>
@endif