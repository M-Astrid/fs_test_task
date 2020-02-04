<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAnswerRepository")
 */
class UserAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="userAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AnswerItem", inversedBy="userAnswers")
     */
    private $answer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $answerText;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Completed", inversedBy="userAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $completed;

    public function __construct()
    {
        $this->answer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection|AnswerItem[]
     */
    public function getAnswer(): Collection
    {
        return $this->answer;
    }

    public function addAnswer(AnswerItem $answer): self
    {
        if (!$this->answer->contains($answer)) {
            $this->answer[] = $answer;
        }

        return $this;
    }

    public function removeAnswer(AnswerItem $answer): self
    {
        if ($this->answer->contains($answer)) {
            $this->answer->removeElement($answer);
        }

        return $this;
    }

    public function getAnswerText(): ?string
    {
        return $this->answerText;
    }

    public function setAnswerText(?string $answerText): self
    {
        $this->answerText = $answerText;

        return $this;
    }

    public function getCompleted(): ?Completed
    {
        return $this->completed;
    }

    public function setCompleted(?Completed $completed): self
    {
        $this->completed = $completed;

        return $this;
    }
}
