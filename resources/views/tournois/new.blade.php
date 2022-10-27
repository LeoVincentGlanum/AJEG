@extends('layouts.app')


@section('content')

    <div class="container mt-5">
    <livewire:tournois-form />
    </div>
{{--    <div class="container mt-5">--}}
{{--        <form method="post" action="{{route('tournois.store')}}">--}}
{{--            @csrf--}}
{{--            <div class="mb-3">--}}
{{--                <label for="exampleInputEmail1" class="form-label">Nom du tournois</label>--}}
{{--                <input REQUIRED type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">--}}

{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="exampleInputPassword1" class="form-label">CashPrize Perso</label>--}}
{{--                <input type="number" class="form-control" name="cashPrize" id="exampleInputPassword1">--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="exampleInputPassword1" class="form-label">Demander un CashPrize MODO</label>--}}
{{--                <input type="number" name="cashPrizeModo" class="form-control" id="exampleInputPassword1">--}}
{{--            </div>--}}
{{--            <div class="mb-3 form-check">--}}
{{--                <input type="checkbox" class="form-check-input" name="notif" id="exampleCheck1">--}}
{{--                <label class="form-check-label"  for="exampleCheck1">M'avertir quand quelqu'un s'inscrit</label>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Creer le tournois</button>--}}
{{--        </form>--}}
{{--    </div>--}}

@endsection
