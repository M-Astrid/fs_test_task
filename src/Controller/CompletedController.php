<?php

namespace App\Controller;

use App\Entity\UserAnswer;
use App\Repository\CompletedRepository;
use App\Repository\TestRepository;
use App\Repository\UserAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompletedController extends AbstractController
{
    /**
     * @Route("/completed/{completedId}", name="completed_show")
     */
    public function show($completedId, CompletedRepository $rep)
    {
        $completed = $rep->find($completedId);
        $test = $completed->getTest();
        $questions = $test->getQuestions();
        $userAnswers = $this->getUserAnswers($completedId); // joined questions and answer items

        $results = array();
        $falseAnswers = 0;

        foreach ($userAnswers as $userAnswer)
        {
            // compare user answer and the right
            $question = $userAnswer->getQuestion();
            $questionId = $question->getId();
            $questionType = $question->getType()->getId();

            switch ($questionType)
            {
                case 3:
                    $userAnswerText = $userAnswer->getAnswerText();
                    $rightAnswer = $question->getAnswerItems()[0]->getText();
                    $results[$questionId][0] = $userAnswerText == $rightAnswer;
                    $results[$questionId]['user_answer'] = $userAnswerText;
                    if (!$results[$questionId][0])
                    {
                        $falseAnswers ++;
                        $results[$questionId]['right_answer'] = $rightAnswer;
                        $results[$questionId]['user_answer'] = $userAnswerText;
                    }
                    break;
                default:
                    $answers = $userAnswer->getAnswer();
                    foreach($answers as $answer)
                    {
                        $answerId = $answer->getId();
                        $results[$questionId][$answerId] = $answer->getIsRight();
                        if (!isset($results[$questionId]['right']) and !$answer->getIsRight())
                        {
                            foreach ($question->getAnswerItems() as $answerItem)
                            {
                                if ($answerItem->getIsRight() == 1)
                                {
                                    $results[$questionId]['right_answers'][] = $answerItem->getText();
                                }
                            }
                            $falseAnswers += 1;
                        }
                    }
            }
        }
        $totalQuestions = count($questions);
        $rightAnswers = $totalQuestions - $falseAnswers;


        // get all questions and results array
        return $this->render('completed/show.html.twig', [
            'test' => $test,
            'results' => $results,
            'questions' => $questions,
            'rightAnswers' => $rightAnswers,
            'totalQuestions' => $totalQuestions,
        ]);
    }

    /**
     * @Route("/completed/", name="completed_list")
     */
    public function passedList()
    {
        $user = $this->getUser();

        $tests = $user->getCompletedTests();

        return $this->render('completed/list.html.twig', [
            'tests' => $tests,
        ]);
    }

    private function getUserAnswers($completedId)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(UserAnswer::class);
        // get all user answers for this test joined question, answerItem, questionType objects
        $userAnswers = $repository->findByCompletedId($completedId);
        return $userAnswers;
    }
}
