@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        <h1>Administration Panel</h1>
        <livewire:type-game-form />
        <livewire:type-game-show />
    </div>
@endsection
