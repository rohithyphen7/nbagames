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