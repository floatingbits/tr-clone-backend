<?php
/**
 * This file contains only the class {@see unknown}
 * @author Sören Parton
 * @since 2017-01-02
 */


namespace App\Services\v1;

use App\Board;
use App\Card;
use App\CardList;
use Illuminate\Http\Request;


/**
 * Class CardListsService
 * 
 * @author Sören Parton
 */
class CardListsService {
    /**
     * @param int $boardId
     * @return array
     * @author Sören Parton
     */
    public function getLists($boardId) {
        $withKeys = array('cards');
        return $this->filterLists(CardList::with($withKeys)->where('board_id', $boardId)->orderBy('weight', 'DESC')->get());
    }

    /**
     * @param  $lists
     * @return array
     * @author Sören Parton
     */
    private function filterLists($lists) {
        $data = [];
        /**
         * @var CardList $list
         */
        foreach ($lists as $list) {
            $entry = [
                'id' => $list->id,
                'title' => $list->title,
                'href' => route('lists.show', ['id' => $list->id])
            ];
            $entry['cards'] = array();
            /**
             * @var Card $card
             */
            foreach ($list->cards as $card) {
                $entry['cards'][] = array('title' => $card->title, 'id' => $card->id);
            }
            $data[] = $entry;
        }
        return $data;
    }

    /**
     * @param Request $request
     * @return CardList
     * @author Sören Parton
     */
    public function createList(Request $request) {
        $title = $request->input('title');
        $boardId = $request->input('boardId');
        $board = Board::query()->find($boardId);
        $list = new CardList();
        $list->title = $title;
        $list->board()->associate($board);
        $list->weight = 10;
        $list->save();
        return $this->filterLists(array($list))[0];
    }
    /**
     * @param Request $request
     * @return CardList
     * @author Sören Parton
     */
    public function updateList(Request $request, $id) {

        $list = CardList::query()->find($id);
        $boardId = $request->input('boardId');
        if ($boardId) {
            $board = Board::query()->find($boardId);
            $list->board()->associate($board);
        }
        $title = $request->input('title');
        if ($title) {
            $list->title = $title;
        }
        $weight = $request->input('weight');
        if ($weight) {
            $list->weight = 10;
        }

        $list->save();
        return $this->filterLists(array($list))[0];
    }
} 