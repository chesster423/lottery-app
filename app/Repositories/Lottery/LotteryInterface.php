<?php

namespace App\Repositories\Lottery;

interface LotteryInterface {

    public function getLotteriesByUser();

    public function findLotteryByEntries($combination);

    public function find($id);

    public function saveUserLottery($user);

}