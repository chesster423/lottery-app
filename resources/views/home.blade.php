@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <create-lottery-component class="mt-3"></create-lottery-component>
        <user-lottery-component class="mt-3"></user-lottery-component>

    </div>
</div>

@endsection
