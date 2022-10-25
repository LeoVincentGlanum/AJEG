@extends('layout.app')

@section('content')

<div class="container">
     
    <div class="card">
        <div class="card-body">
            <livewire:user-datatables
                searchable="name"
                language="fr"
            />
        </div>
    </div>

</div>

@endsection

@section('script')
@endsection


