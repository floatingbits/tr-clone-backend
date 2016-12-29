<?php
/**
 * This file contains only the class {@see unknown}
 * @author Sören Parton
 * @since 2016-12-29
 */


namespace App\Services\v1;

use App\Board;
/**
 * Class BoardsService
 * 
 * @author Sören Parton
 */
class BoardsService {
    protected $supportedIncludes = [
        'cardLists' => 'lists'
    ];
    public function getBoards($parameters) {
        if (empty($parameters)) {
            return $this->filterBoards(Board::all());
        }
        $withKeys = array();
        if (isset($parameters['include'])) {
            $includeParams = explode(',', $parameters['include']);
            $includes = array_intersect($this->supportedIncludes, $includeParams);
            $withKeys = array_keys($includes);
        }

        return $this->filterBoards(Board::with($withKeys)->get(), $withKeys);

    }
    public function getBoard($id) {
        return $this->filterBoards(Board::where('id', $id)->get());
    }

    private function filterBoards($boards, $withKeys = array()) {
        $data = [];
        /**
         * @var Board $board
         */
        foreach ($boards as $board) {
            $entry = [
                'id' => $board->id,
                'title' => $board->title,
                'href' => route('boards.show', ['id' => $board->id])
            ];
            if (in_array('cardLists', $withKeys)) {
                $entry['lists'] = [];
                foreach ($board->cardLists as $list) {
                    $entry['lists'][] = [
                        'title' => $list->title,
                        'id' => $list->id,
                        'weight' => $list->weight
                    ];
                }
            }
            $data[] = $entry;
        }
        return $data;
    }
} 