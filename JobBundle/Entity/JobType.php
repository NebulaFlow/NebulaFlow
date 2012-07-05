<?php

namespace NebulaFlow\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NebulaFlow\JobBundle\Entity\JobType
 *
 * @ORM\Table(name="jobtypes")
 * @ORM\Entity
 */
class JobType
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\OneToMany(targetEntity="Job", mappedBy="type")
     */
    private $id;

    /**
     * @var string $name
	 *
	 * The name of the type of job.
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return JobType
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}