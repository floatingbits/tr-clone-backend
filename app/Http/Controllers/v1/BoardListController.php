<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\CardListsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardListController extends Controller
{
    /**
     * @var \App\Services\v1\CardListsService
     */
    protected $cardLists;

    public function __construct(CardListsService $service) {
        $this->cardLists = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($boardId)
    {
        return $this->cardLists->getLists($boardId);
    }
}
