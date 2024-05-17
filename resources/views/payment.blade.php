@extends('master')
@section('content')
<div class="container" style="margin: 50px">
<form method="POST" action="{{route('pay')}}">
    @csrf
    <button type="submit" class="btn btn-primary btn-sm">Pay with Paystack</button>
</form>
</div>
@endsection