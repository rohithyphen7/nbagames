<div class="modal" id="teamDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><strong> Players List for team @{{teamDetails.name}}</strong></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                    <tr ng-repeat="players in teamDetails.players">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>