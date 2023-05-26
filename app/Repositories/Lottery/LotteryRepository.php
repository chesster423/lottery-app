<?php

namespace App\Repositories\Lottery;

use App\Repositories\Lottery\LotteryInterface as LotteryInterface;
use App\Models\Lottery;

use Carbon\Carbon;

class LotteryRepository implements LotteryInterface
{

    public $lottery;

    function __construct(Lottery $lottery) {

		$this->lottery = $lottery;

    }

    public function getLotteriesByUser(){

        $user_id = auth()->user()->id;
        return $this->lottery::where('user_id', $user_id)->orderBy('id', 'DESC')->get();

    }

    public function findLotteryByEntries($combinations) {

    	$lottery = $this->lottery::whereIn('combinations', $combinations)->get();

    	return $lottery;

    }

    public function saveUserLottery($entries) {

        $user_id = auth()->user()->id;
        $payload = [];

        foreach($entries as $key => $value) {
            $payload[] = [
                'user_id' => $user_id,
                'combinations' => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        $product= Lottery::insert($payload);

        return $product;
        
    }
 
    public function find($id){

        return $this->lottery->find($id);

    }


}
