@extends('home')
@section('title', 'Teams')

@section('content')
    <script src="{{asset('js/teams.js')}}">
    </script>
    <div class="row" ng-controller="teamController" ng-cloak>
        @include('teamList')
        @include('players')
    </div>

@endsection