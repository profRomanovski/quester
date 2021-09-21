<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{

    public function run()
    {
        /**
         * @var User
         */
        $user = User::query()->firstOrCreate([
            'name' => 'Roman Gurniy',
            'email' => 'roman@gmail.com',
            'password' => 'qwerty12A',
            'email_verified_at' => now(),
        ]);

        /**
         * @var Test $test
         */
        $test = Test::query()->firstOrCreate([
            Test::NAME => 'Наскільки хороша ви людина?',
            Test::COMPLETED => 0,
            Test::USER_ID => $user->id
        ]);

        /**
         * @var Question $question1
         */
        $question1 = Question::query()->firstOrCreate([
            Question::TEST_ID => $test->getId(),
            Question::VALUE => 'Як часто ви робите добрі вчинки?',
        ]);

        Answer::query()->firstOrCreate([
            Answer::QUESTION_ID => $question1->getId(),
            Answer::VALUE => 'Часто',
            Answer::IS_CORRECT => true
        ]);

        Answer::query()->firstOrCreate([
            Answer::QUESTION_ID => $question1->getId(),
            Answer::VALUE => 'Рідко',
        ]);

        Answer::query()->firstOrCreate([
            Answer::QUESTION_ID => $question1->getId(),
            Answer::VALUE => 'Майже ніколи',
        ]);

        /**
         * @var Question $question2
         */
        $question2 = Question::query()->firstOrCreate([
            Question::TEST_ID => $test->getId(),
            Question::VALUE => 'Як часто ви робите погані вчинки?',
        ]);

        Answer::query()->firstOrCreate([
            Answer::QUESTION_ID => $question2->getId(),
            Answer::VALUE => 'Майже ніколи',
            Answer::IS_CORRECT => true
        ]);

        Answer::query()->firstOrCreate([
            Answer::QUESTION_ID => $question2->getId(),
            Answer::VALUE => 'Час від часу',
        ]);

        Answer::query()->firstOrCreate([
            Answer::QUESTION_ID => $question2->getId(),
            Answer::VALUE => 'Часто',
        ]);

        /**
         * @var Question $question3
         */
        $question3 = Question::query()->firstOrCreate([
            Question::TEST_ID => $test->getId(),
            Question::VALUE => 'Ви намагаєтесь ділитись позитивом?',
        ]);

        Answer::query()->firstOrCreate([
            Answer::QUESTION_ID => $question3->getId(),
            Answer::VALUE => 'Так',
            Answer::IS_CORRECT => true
        ]);

        Answer::query()->firstOrCreate([
            Answer::QUESTION_ID => $question3->getId(),
            Answer::VALUE => 'Ні',
        ]);
    }

}
