@extends('home')
@section('title', 'Teams')

@section('content')
    <script>
        app.controller('teamController', function ($scope, $http) {

            $scope.getTeams = function () {
                $http.get("/getTeamsWithGroups")
                    .then(function (response) {
                        $scope.teams = response.data;
                    });
            }
            $scope.getTeams();

            $scope.getTeamPlayers = function () {
                var teamId = this.team.id;
                $http.get("/getTeamsPlayers/" + teamId)
                    .then(function (response) {
                        $scope.teamDetails = response.data;
                        $('#teamDetailsModal').modal();

                    });
            }

        });
    </script>
    <div class="row" ng-controller="teamController" ng-cloak>
        @include('teamList')
        @include('players')
    </div>

@endsection