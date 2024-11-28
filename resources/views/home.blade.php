@extends('layouts.app')

@section('content')
<div>
    <h3 class="text-3xl dark:text-white">Welcome back, <b>ChimpGamer</b></h3>

    <div>
        <livewire:my-tickets-table />
    </div>
</div>
@endsection
