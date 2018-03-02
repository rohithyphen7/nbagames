app.controller('playerController', function ($scope, $http,$timeout) {

    $scope.topPlayers = function () {
        $http.get("/getTopPlayers")
            .then(function (response) {
                $scope.topPlayers = response.data;
            });
    }
    $scope.topPlayers();
});