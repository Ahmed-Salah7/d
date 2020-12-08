
@php
    $result = DB::table('employment_contracts')->where('status','1')->where('customer_id', $id )->get();
    $total_result = count($result);
@endphp

	<a href="{{ url('/office-work/contract-list?c_id='.$id) }}">
	{!! $total_result !!}
	</a>

