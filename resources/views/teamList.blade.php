<div class="col-lg-12" ng-repeat="group in teams">
    <h2>@{{group.name}}</h2>
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
        <tr ng-repeat="team in group.teams">
            <td>@{{ $index+1 }}</td>
            <td><a href="javascript:void(0)" ng-click="getTeamPlayers()">@{{team.name}}</a></td>
            <td>@{{ team.total_matches }}</td>
            <td>@{{ team.win }}</td>
            <td>@{{ team.loose }}</td>
            <td>@{{ team.draw }}</td>
            <td>@{{ team.points }}</td>
        </tr>
        </tbody>
    </table>
</div>