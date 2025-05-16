<?php

namespace App\Http\Controllers;

use App\Models\Examtest;
use App\Models\TestAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PassTestController extends Controller
{
    public function index($id)
    {
        $test = Examtest::with(['questions.options'])->findOrFail($id);
        session(['started_at_' . $id => now()]); // фиксируем начало прохождения
        return view('pages.forms.passTest', compact('test'));
    }

    public function submit(Request $request, $id)
    {
        $test = Examtest::with(['questions.options'])->findOrFail($id);
        $userId = Auth::id();
        $hasTextQuestion = false;
        $score = 0;
        $maxScore = 0;
        $correct = 0;
        $total = 0;

        foreach ($test->questions as $question) {
            $total++;

            // Вопрос с текстовым ответом
            if ($question->type === 'text') {
                $hasTextQuestion = true;
                continue;
            }

            $options = $question->options;
            $correctOptions = $options->where('is_correct', true);
            $correctIds = $correctOptions->pluck('id')->toArray();

            if ($question->type === 'single') {
                $userAnswer = $request->input("answers.{$question->id}");
                $maxScore += 1;

                if (in_array($userAnswer, $correctIds)) {
                    $score += 1;
                    $correct++;
                }
            }

            if ($question->type === 'multiple') {
                $userAnswers = $request->input("answers.{$question->id}", []);
                $userAnswers = array_map('intval', $userAnswers);
                sort($userAnswers);
                sort($correctIds);

                $maxScore += 1;

                // если выбраны ровно правильные варианты
                if (!array_diff($userAnswers, $correctIds) && !array_diff($correctIds, $userAnswers)) {
                    $score += 1;
                    $correct++;
                } else {
                    // если есть хотя бы один неправильный
                    if (array_diff($userAnswers, $correctIds)) {
                        // балл 0
                    } else {
                        // частично правильные без ошибок
                        $partialScore = count(array_intersect($userAnswers, $correctIds)) / count($correctIds);
                        $score += $partialScore;
                    }
                }
            }
        }

        // Расчет процента
        $percent = $maxScore > 0 ? intval(($score / $maxScore) * 100) : 0;

        if ($percent < 50) {
            $grade = 2;
        } elseif ($percent < 75) {
            $grade = 3;
        } elseif ($percent < 90) {
            $grade = 4;
        } else {
            $grade = 5;
        }

        // Сохраняем попытку
        $startedAt = session('started_at_' . $id, now());

        TestAttempt::create([
            'user_id' => $userId,
            'examtest_id' => $id,
            'score' => $score,
            'percent' => $percent,
            'correct' => $correct,
            'total' => $total,
            'grade' => $grade,
            'started_at' => $startedAt,
            'finished_at' => now(),
        ]);

        if ($hasTextQuestion) {
            return view('pages.forms.testResult')->with([
                'message' => 'О результатах тестирования станет известно после проверки преподавателем.',
                'pending' => true,
            ]);
        }

        return view('pages.forms.testResult')->with([
            'score' => $score,
            'maxScore' => $maxScore,
            'percent' => $percent,
            'grade' => $grade,
            'pending' => false,
        ]);
    }
}
