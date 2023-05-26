<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Lottery\LotteryRepository as LotteryRepository;
use App\Services\LotteryService;

class LotteryController extends Controller
{
    //
    public $lottery;
    //
    public function __construct(LotteryRepository $lotteryRepository)
    {
        $this->lottery = $lotteryRepository;

    }

    public function saveEntries(Request $request, LotteryService $lotteryService) {

        $data = $request->all();

        if($errors = $lotteryService->validateLotteryEntries($data['combinations'])) {
            return response()->json(['success' => false, 'errors' => $errors]);
        }

        $entries = $lotteryService->concatEntries($data['combinations']);

        if($duplicate_db_entries = $this->lottery->findLotteryByEntries($entries)) {

            if($duplicate_db_entries->count() > 0) {
                return response()->json(['success' => false, 'errors' => ['Some entries are already taken.'], 'data' => $duplicate_db_entries]);
            }
            
            if($this->lottery->saveUserLottery($entries)) {
                return response()->json(['success' => true, 'errors' => [], 'msg' => 'Entries saved successfully.']);
            }
        }
        
        return response()->json(['success' => false, 'errors' => ['An error occurred.']]);

    }

    public function getLotteriesByUser(Request $request) {

        $data = $this->lottery->getLotteriesByUser();

        return response()->json(['success' => true, 'errors' => [], 'msg' => 'Entries fetched!.' , 'data' => $data]);

    }
    
}
