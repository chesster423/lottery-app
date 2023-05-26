<?php

namespace App\Services;

class LotteryService
{      

    public function validateLotteryEntries($entries) {
        
        $invalid_entries = 0;
        $duplicates = 0;

        $errors = [];

        foreach($entries as $key => $value) {

            // check if there are incomplete entry.
            if (count($value) < 6) {
                $invalid_entries +=1 ;
            }

            // check if there are duplicated numbers on one entry
            if(count($value) !== count(array_unique($value))) {
                $duplicates += 1;
            } 
        }

        if ($invalid_entries > 0) {
            $errors[] = "Some entries are incomplete.";
        }

        if ($duplicates > 0) {
            $errors[] = "Some entries have duplicate combinations.";
        }

        $data = $this->concatEntries($entries);
        
        // check if entries have duplicates
        if(count($data) !== count(array_unique($data)) && $invalid_entries == 0) {
            $errors[] = "You cannot put the same combinations.";
        }

        return $errors;
        
    }

    public function concatEntries($entries) {

        $data = [];
        
        foreach($entries as $key => $value) {
            sort($value);
            $data[] = implode("-", $value);

        }

        return $data;
        
    }

}

