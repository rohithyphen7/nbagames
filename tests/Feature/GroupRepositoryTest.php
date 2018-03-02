<?php

namespace Tests\Feature;

use App\Repositories\GroupRepository;
use Tests\TestCase;
use Mockery;

class GroupRepositoryTest extends TestCase
{

    public $groupRepo;
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
        $this->groupRepo = Mockery::mock(GroupRepository::class)->makePartial();
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
            'getGroupsWithTeams',
        ];

        foreach ($methodsToCheck as $method) {
            $this->checkMethodExist($this->groupRepo, $method);
        }
    }

    /**
     * @test
     */
    public function getGroupsWithTeamsTest()
    {
        $actualData = $this->groupRepo->getGroupsWithTeams();
        $this->assertInternalType('object', $actualData);
    }

}