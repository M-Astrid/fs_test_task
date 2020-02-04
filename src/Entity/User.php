<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="user")
*/
class User extends BaseUser
{
/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Completed", mappedBy="user")
 */
private $completedTests;

public function __construct()
{
parent::__construct();
$this->completedTests = new ArrayCollection();
// your own logic
}

/**
 * @return Collection|Completed[]
 */
public function getCompletedTests(): Collection
{
    return $this->completedTests;
}

public function addCompletedTest(Completed $completedTest): self
{
    if (!$this->completedTests->contains($completedTest)) {
        $this->completedTests[] = $completedTest;
        $completedTest->setUser($this);
    }

    return $this;
}

public function removeCompletedTest(Completed $completedTest): self
{
    if ($this->completedTests->contains($completedTest)) {
        $this->completedTests->removeElement($completedTest);
        // set the owning side to null (unless already changed)
        if ($completedTest->getUser() === $this) {
            $completedTest->setUser(null);
        }
    }

    return $this;
}
}