@extends('home')
@section('title', 'Players')

@section('content')
    <script src="{{asset('js/players.js')}}">
    </script>
    <div class="row" ng-controller="playerController" ng-cloak>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>S.No.</th>
                <th>Player Name</th>
                <th>Age</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Experience</th>
                <th>Points</th>
                <th>Rebounds</th>
                <th>Assists</th>
                <th>PIE</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="players in topPlayers">
                <td>@{{ $index+1 }}</td>
                <td>@{{players.name}}</td>
                <td>@{{ players.age }}</td>
                <td>@{{ players.height }} cm</td>
                <td>@{{ players.weight }} lbs</td>
                <td>@{{ players.experience }} years</td>
                <td>@{{ players.points }}</td>
                <td>@{{ players.rebound }}</td>
                <td>@{{ players.assist }}</td>
                <td>@{{ players.player_impact_estimate }}</td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection