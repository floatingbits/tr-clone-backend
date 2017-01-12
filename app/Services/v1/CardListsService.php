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

        return $this->filterLists(CardList::with(['cards' => function ($q) {
               $q->orderBy('weight', 'asc');
            }])->where('board_id', $boardId)->orderBy('weight', 'ASC')->get());
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
     * @param int $id
     * @return array
     * @author Sören Parton
     */
    public function updateList(Request $request, $id) {
        /** @var CardList $list */
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
        if (!is_null($weight)) {
            $list->weight = $weight;
        }
        $cards = $request->input('cards');
        if ($cards) {
            foreach ($cards as $card) {
                if ($card['id']) {
                    /** @var Card $storedCard */
                    $cardModel = Card::query()->find($card['id']);
                }
                else {
                    $cardModel = new Card();

                }
                $cardModel->cardList()->associate($list);
                if (isset($card['weight'])) {
                    $cardModel->weight = $card['weight'];
                }
                if (isset($card['title'])) {
                    $cardModel->title = $card['title'];
                }
                $cardModel->save();

            }
        }

        $list->save();
        return $this->filterLists(array($list))[0];
    }
} 