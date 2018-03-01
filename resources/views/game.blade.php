@extends('home')
@section('title', 'Game')
@section('content')
<script>
    app.controller('gameController', function ($scope, $http,$timeout) {

        $scope.getGameMatches = function () {
            $http.get("/getMatches")
                .then(function (response) {
                    $scope.games = response.data;
                });
        }
        $scope.getGameMatches();
        setInterval(function(){
            $scope.getGameMatches();
        }, 5000)

        $scope.getPlayingPlayers = function () {
            var teamAid = this.game.teamA_id;
            var teamBid = this.game.teamB_id;
            $http.get("/playingPlayers/"+teamAid+'/'+teamBid)
                .then(function (response) {
                    $scope.teamA = response.data.teamA;
                    $scope.teamB = response.data.teamB;
                    $('#playingPlayers').modal();
                });
        }

        $scope.startGame = function () {
            $http.get("/startGame")
                .then(function (response) {
                });
        }
    });
</script>
<div class="row" ng-controller="gameController"  ng-cloak>
    <h1></h1>
    <button type="button" ng-click="startGame()" class="btn btn-primary" data-dismiss="modal">Start Game</button>
    <h1></h1>
    <div class="panel panel-default" ng-repeat = "game in games">
        <div class="panel-heading">Match @{{ $index+1 }}</div>
        <div class="list-group">
            <a href="#" class="list-group-item" ng-click="getPlayingPlayers()">
                <h3 class="list-group-item-heading">@{{ game.team_a.name}} <strong><i>vs</i></strong> @{{ game.team_b.name }}</h3>
                <h5 class="list-group-item-text"><strong>Score - <i>@{{ game.score_of_team_a[0].score || 0 }}  <strong><i>vs</i></strong> @{{ game.score_of_team_b[0].score || 0}}</i></strong></h5>
                <h5 class="list-group-item-text"><strong>Attack Count - <i>@{{ game.score_of_team_a[0].attack_count || 0}} <strong><i>vs</i></strong> @{{ game.score_of_team_b[0].attack_count || 0}}</i></strong></h5>
                <h5 class="list-group-item-text"><strong>Player based assists - <i>@{{ game.score_of_team_a[0].assist || 0}} <strong><i>vs</i></strong> @{{ game.score_of_team_b[0].assist || 0 }}</i></strong></h5>
                <h5 class="list-group-item-text"><strong>Success rate - <i>Team A @{{ game.score_of_team_a[0].success_rate|| 0 }}
                            out of @{{ game.score_of_team_a[0].attack_count|| 0 }} and for Team B @{{ game.score_of_team_b[0].success_rate || 0}}
                            out of @{{ game.score_of_team_b[0].attack_count || 0}}</i></strong></h5>
            </a>
        </div>
    </div>
@include('teamInfo')
</div>
@endsection