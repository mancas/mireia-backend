<?php

namespace MireiaBackend\ProjectBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Project extends BaseEntity
{
    /**
     * @ORM\OneToMany(targetEntity="MireiaBackend\ProjectBundle\Entity\Section", mappedBy="project", cascade={"persist", "merge", "remove"})
     */
    protected $sections;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param mixed $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
    }

    public function addSecction($section)
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
        }
    }

    public function removeSection($section)
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
        }
    }
}
