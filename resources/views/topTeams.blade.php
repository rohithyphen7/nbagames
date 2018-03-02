@extends('home')
@section('pageTitle', 'Top Teams')

@section('content')
    <script>
        app.controller('topTeamsController', function ($scope, $http) {
            $scope.getTeamPlayers = function () {
                $http.get("/getTopTeams")
                    .then(function (response) {
                        $scope.teams = response.data;
                    });
            }
            $scope.getTeamPlayers();
        })
    </script>
    <div class="row" ng-controller="topTeamsController" ng-cloak>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Team Rank</th>
                <th>Team Name</th>
                <th>Total Matches</th>
                <th>Win</th>
                <th>Loose</th>
                <th>Draw</th>
                <th>Points</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="team in teams">
                <td>@{{ $index+1 }}</td>
                <td>@{{team.name}}</td>
                <td>@{{ team.total_matches }}</td>
                <td>@{{ team.win }}</td>
                <td>@{{ team.loose }}</td>
                <td>@{{ team.draw }}</td>
                <td>@{{ team.points }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection