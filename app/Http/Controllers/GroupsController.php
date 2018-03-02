<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\GroupInterFace;

class GroupsController extends Controller
{

    protected $groupRepo;

    /**
     * GroupsController constructor.
     *
     * @param App /Interfaces/GroupInterFace $groupRepo
     *            perform Dependency Injection to a Interface which is implemented by repo
     *            Dependency injection also allow to typeCast the @param
     *            Following Repository pattern
     * @author Rohit N
     */
    public function __construct(GroupInterFace $groupRepo)
    {
        $this->groupRepo = $groupRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->groupRepo->getGroupsWithTeams();
    }

}
