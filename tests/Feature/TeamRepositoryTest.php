<?php

namespace Tests\Feature;

use App\Repositories\TeamRepository;
use Tests\TestCase;
use Mockery;

class TeamRepositoryTest extends TestCase
{
    public $teamRepo;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function setUp()
    {
        parent::setUp();
        $this->teamRepo = Mockery::mock(TeamRepository::class)->makePartial();
    }

    public function tearDown()
    {
        // DO NOT DELETE
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function check_if_method_exists()
    {
        $methodsToCheck = [
            'getTeamDetailsWithPlayers',
            'getPlayers',
            'getPlayingPlayers',
            'getTopPlayers',
        ];

        foreach ($methodsToCheck as $method) {
            $this->checkMethodExist($this->teamRepo, $method);
        }
    }

    /**
     * @test
     */
    public function getPlayersTest()
    {
        $teamA_id  = 1;
        $teamB_id  = 2;
        $actualData = $this->teamRepo->getPlayers($teamA_id,$teamB_id);
        $this->assertInternalType('array', $actualData);
        $this->assertInternalType('int', $teamA_id);
        $this->assertInternalType('int', $teamB_id);
    }

    /**
     * @test
     */
    public function getPlayingPlayersTest()
    {
        $teamA_id  = 1;
        $actualData = $this->teamRepo->getPlayingPlayers($teamA_id);
        $this->assertInternalType('object', $actualData);
        $this->assertInternalType('int', $teamA_id);
    }

    /**
     * @test
     */
    public function getTopPlayersTest()
    {
        $actualData = $this->teamRepo->getTopPlayers();
        $this->assertInternalType('object', $actualData);
    }

    /**
     * @test
     */
    public function getTeamDetailsWithPlayersTest()
    {
        $team_id  = 1;
        $actualData = $this->teamRepo->getTeamDetailsWithPlayers($team_id);
        $this->assertInternalType('object', $actualData);
    }
}
