<?php

namespace App\Http\Controllers;

use App\Helpers\TestHelper;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Result;
use App\Models\Test;
use App\Models\TestComplete;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @var TestHelper
     */
    protected $helper;

    public function __construct(TestHelper $helper)
    {
        $this->helper = $helper;
    }

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
       return $this->saveTestContent($test, $postData);
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
        $resultLabel = $this->helper->getResultLabel($test, $resultMark);
        TestComplete::query()->create([
            'test_id' => $test->getId(),
            'user_id' => auth()->user()->id,
            'result' => $resultMark
        ]);
        $test->update(['completed' => $test->getCompleted()+1]);
        return view('layouts.test-complete-result',
        compact('questionCount', 'resultLabel', 'resultMark'));
    }

    public function testStatistic(Request $request){
        $id = $request->get('id');
        $test = Test::query()->find($id);
        $questions = Question::query()
            ->where('test_id', '=',$test->getId())->count();
        $results = TestComplete::query()
            ->where('test_id', '=', $test->getId())
            ->with('user')
            ->get();
        $helper = $this->helper;
        return view('layouts.test-statistic',
            compact('test', 'results', 'questions', 'helper'));
    }

    public function testStatisticDelete(Request $request)
    {
        $id = $request->get('id');
        $test = Test::query()->find($id);
        TestComplete::query()
            ->where('test_id','=',$test->getId())
            ->delete();
        return redirect()->route('test.statistic',['id'=>$test->getId()]);
    }

    public function testStatisticSearch(Request $request)
    {
        $id = $request->post('test-id');
        $test = Test::query()->find($id);
        $search = $request->post('search');
        $questions = Question::query()
            ->where('test_id', '=',$test->getId())->count();
        $userIds = [];
        $usersName = User::query()
            ->where('name', 'like', '%'.$search.'%')
            ->orWhere('email','like', '%'.$search.'%')
            ->get();
        foreach ($usersName as $user){
            if(!in_array($user->getId(), $userIds))
                array_push($userIds, $user->getId());
        }
        $results = TestComplete::query()
            ->where('test_id', '=', $test->getId())
            ->whereIn('user_id', $userIds)
            ->with('user')
            ->get();
        $helper = $this->helper;
        return view('layouts.test-statistic',
            compact('test', 'results', 'questions', 'helper'));
    }

    public function testDelete(Request $request){
        $id = $request->get('id');
        Test::query()->where('id','=', $id)->delete();
        return redirect()->route('home');
    }

    public function userStatistic()
    {
        $results = TestComplete::query()
            ->where('user_id', '=', auth()->user()->id)
            ->with('test')
            ->get();
        $helper = $this->helper;
        return view('layouts.user-statistic',
            compact( 'results', 'helper'));
    }

    public function userStatisticDelete()
    {
        TestComplete::query()
            ->where('user_id','=',auth()->user()->id)
            ->delete();
        return redirect()->route('user.statistic');
    }
}
