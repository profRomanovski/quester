<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Result;
use App\Models\Test;
use App\Models\TestComplete;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testView(Request $request)
    {
        $id = $request->get('id');
        /**
         * @var Test $test
         */
        $test = Test::query()->find($id);
        $questions = Question::query()->
        where('test_id', '=', $test->getId())->
        with('answers')->get();
        return view('layouts.test-view', compact('test', 'questions'));
    }

    public function testCreate()
    {
        return view('layouts.test-create');
    }

    protected function saveTestContent($test, $postData){
        $questions = [];
        foreach (array_keys($postData) as $data) {
            if ($data[0] === 'q') $questions[$data] = $postData[$data];
        }
        if (count($questions) === 0) {
            $test->delete();
            return $this->viewWithMessage('layouts.test-create',
                'Помилка',
                'Тест має включати хочаб одне питання');
        }
        foreach ($questions as $questionKey => $questionValue) {
            $question = Question::query()->create([
                'test_id' => $test->getId(),
                'value' => $questionValue
            ]);
            if(isset($postData['radio-' . $questionKey[2]])){
                $answerCorrectKey = $postData['radio-' . $questionKey[2]];
            }
            else{
                $test->delete();
                return $this->viewWithMessage('layouts.test-create',
                    'Помилка',
                    'Питання має містити хочаб одну відповідь');
            }
            foreach ($postData as $key => $value) {
                if ($key[0] === 'a' && $key[2] === $questionKey[2]) {
                    $answerCount = +1;
                    $isCorrect = 0;
                    if ($key === $answerCorrectKey) {
                        $isCorrect = 1;
                    }
                    Answer::query()->create([
                        'question_id' => $question->getId(),
                        'value' => $value,
                        'is_correct' => $isCorrect
                    ]);
                }
            }
        }
        return redirect()->route('test.view',['id'=>$test->getId()]);
    }
    public function testCreateAction(Request $request)
    {
        $postData = $request->all();
        $test = Test::query()->create([
            'name' => $postData['test-name'],
            'user_id' => auth()->user()->getId(),
            'completed' => 0
        ]);
        $this->saveTestContent($test, $postData);
    }

    public function testEdit(Request $request)
    {
        $testId = $request->get('id');
        $test = Test::query()->find($testId);
        $questions = Question::query()->
        where('test_id', '=', $test->getId())->
        with('answers')->get();
        return view('layouts.test-edit', compact('test', 'questions'));
    }

    public function testEditAction(Request $request)
    {
        $testId = $request->post('test-id');
        $test = Test::query()->find($testId);
        $postData = $request->all();
        $test->update(['name'=>$request->post('test-name')]);
        Question::query()->where('test_id', '=', $test->getId())->delete();
        return $this->saveTestContent($test, $postData);
    }

    public function testResult(Request $request)
    {
        $testId = $request->get('id');
        $test = Test::query()->find($testId);
        $mark = Question::query()
            ->where('test_id', '=',$test->getId())->count();
        $results = Result::query()->where('test_id','=',$test->getId())->get();
        return view('layouts.test-result', compact('test', 'mark','results'));
    }

    public function testResultAction(Request $request)
    {
        $testId = $request->post('test-id');
        $test = Test::query()->find($testId);
        $results = [];
        $postData = $request->all();
        foreach ($postData as $key => $data){
            if($key[0] === 'r'){
                $results[$key] = $data;
            }
        }
        if(count($results) === 0){
            return $this->viewWithMessage('layouts.test-result',
                'Помилка',
                'Тест має мати хочаб один результат');
        }
        Result::query()->where('test_id', '=', $test->getId())->delete();
        foreach ($results as $key=>$result){
            Result::query()->create([
                'test_id' => $test->getId(),
                'condition' => $postData['condition-r-'.$key[2]],
                'mark' => $postData['mark-r-'.$key[2]],
                'value' => $result
            ]);
        }
        return redirect()->route('test.result',['id'=>$test->getId()]);
    }

    public function testComplete(Request $request)
    {
        $id = $request->get('id');
        $test = Test::query()->find($id);
        $questions = Question::query()->
        where('test_id', '=', $test->getId())->
        with('answers')->get();
        return view('layouts.test-complete', compact('test', 'questions'));
    }

    public function testCompleteAction(Request $request)
    {
        $testId = $request->post('test-id');
        $test = Test::query()->find($testId);
        $questionCount = Question::query()
            ->where('test_id', '=',$test->getId())->count();
        $resultMark = 0;
        foreach ($request->all() as $key => $data){
            if($key[0] === 'r'){
                $answer = Answer::query()->find($data);
                if($answer->getIsCorrect() === 1){
                    $resultMark = $resultMark+1;
                }
            }
        }
        $resultLabel = "";
        $results = Result::query()->where('test_id','=',$test->getId())->get();
        foreach ($results as $result){
            if($result->getCondition() === 1 && $resultMark > $result->getMark()){
                $resultLabel = $result->getValue();
            }
            if($result->getCondition() === 2 &&  $resultMark < $result->getMark()){
                $resultLabel = $result->getValue();
            }
            if($result->getCondition() === 0 && $result->getMark() === $resultMark){
                $resultLabel = $result->getValue();
            }
        }
        TestComplete::query()->create([
            'test_id' => $test->getId(),
            'user_id' => auth()->user()->id,
            'result' => $resultMark
        ]);
        $test->update(['completed' => $test->getCompleted()+1]);
        return view('layouts.test-complete-result',
        compact('questionCount', 'resultLabel', 'resultMark'));
    }
}
