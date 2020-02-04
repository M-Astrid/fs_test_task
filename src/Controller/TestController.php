<?php
namespace App\Controller;

use App\Entity\AnswerItem;
use App\Entity\Completed;
use App\Entity\User;
use App\Entity\UserAnswer;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test_list")
     */
    public function index(TestRepository $repository)
    {
        $tests = $repository->findAll();
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'tests' => $tests,
        ]);
    }

    /**
     * @Route("/test/{id}", name="test_show")
     */
    public function show($id, Request $request, TestRepository $repository)
    {
        $test = $repository->find($id);
        $questions = $test->getQuestions();
        $errors = array();

        if ($request->getMethod() == 'POST')
        {
            // validation:
            // get POST data array
            $data = $request->request;
            // try to find unanswered questions
            $num = 0;
            foreach ($questions as $question)
            {
                $num ++;
                $u_answer = $data->get($question->getId());
                if (null === $u_answer or $u_answer === "") $nums[] = $num;
            } // if found unanswered return errors
            if (isset($nums))
            {
                $errors[] = "You have not answer questions: ".implode(", ", $nums).". Do your best!";
            }

            // if no errors save user answers
            else
            {
                $user = $this->getUser();
                $entityManager = $this->getDoctrine()->getManager();
                $answerItems = $this->getDoctrine()
                    ->getRepository(AnswerItem::class);
                $completed = new Completed();

                // one new UserAnswer object for each question
                foreach ($questions as $question)
                {
                    $userAnswer = new UserAnswer();
                    $userAnswer->setQuestion($question);
                    $userAnswer->setCompleted($completed);

                    $completed->setUser($user);
                    $completed->setTest($test);

                    if ($question->getType()->getId() == 1)
                    {
                        $answer = $answerItems->find($request->request->get($question->getId()));
                        $userAnswer->addAnswer($answer);
                    }
                    elseif ($question->getType()->getId() == 2)
                    {
                        foreach ($request->request->get($question->getId()) as $id)
                        {
                            $answer = $answerItems->find($id);
                            $userAnswer->addAnswer($answer);
                        }
                    }
                    elseif ($question->getType()->getId() == 3)
                    {
                        $answer = $request->request->get($question->getId());
                        $userAnswer->setAnswerText($answer);
                    }
                    $entityManager->persist($userAnswer);
                    $entityManager->persist($completed);
                    $entityManager->flush();
                }
                return $this->redirectToRoute('completed_show', ['completedId' => $completed->getId()]);
            }
        }
        return $this->render('test/show.html.twig', [
            'controller_name' => 'TestController',
            'test' => $test,
            'questions' => $questions,
            'errors' => $errors,
        ]);
    }
}