<?php

namespace App\Helpers;

use App\Models\Question;
use App\Models\Result;

class TestHelper
{
    /**
     * @param $test
     * @param $mark
     * @return string
     */
    public function getResultLabel($test, $mark): string
    {
        $resultLabel = "";
        $results = Result::query()->where('test_id','=',$test->getId())->get();
        foreach ($results as $result){
            if($result->getCondition() === 1 && $mark > $result->getMark()){
                $resultLabel = $result->getValue();
            }
            if($result->getCondition() === 2 &&  $mark < $result->getMark()){
                $resultLabel = $result->getValue();
            }
            if($result->getCondition() === 0 && $result->getMark() === $mark){
                $resultLabel = $result->getValue();
            }
        }
        return $resultLabel;
    }

    public function getTestQuestionCount($test): int
    {
        return Question::query()
            ->where('test_id', '=',$test->getId())->count();
    }
}
