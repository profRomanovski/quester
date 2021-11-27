<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
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

    public function testCreateAction(Request $request)
    {
        $postData = $request->all();
        $questions = [];

        foreach (array_keys($postData) as $data) {
            if ($data[0] === 'q') $questions[$data] = $postData[$data];
        }
        if (count($questions) === 0) {
            return $this->viewWithMessage('layouts.test-create',
                'Помилка',
                'Тест має включати хочаб одне питання');
        }
        $test = Test::query()->create([
            'name' => $postData['test-name'],
            'user_id' => auth()->user()->getId(),
            'completed' => 0
        ]);
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
}
