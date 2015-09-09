<?php

namespace MireiaBackend\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Section extends BaseEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="MireiaBackend\ProjectBundle\Entity\Project", inversedBy="sections")
     */
    protected $project;

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }
}