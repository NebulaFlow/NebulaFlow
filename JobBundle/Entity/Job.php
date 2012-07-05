<?php
namespace NebulaFlow\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NebulaFlow\JobBundle\Entity\Job
 *
 * @ORM\Table(name="jobs")
 * @ORM\Entity
 */
class Job
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $type
	 *
	 * The type of job being raised.
     *
     * @ORM\Column(name="type", type="integer")
	 * @Assert\NotBlank
     */
    private $type;

    /**
     * @var string $subject
	 *
	 * The identified of the object on which the job is performed. This could be something like "Customer:123456" or "Order:20120703-1".
     *
     * @ORM\Column(name="subject", type="string", length=255)
	 * @Assert\NotBlank
     */
    private $subject;

    /**
     * @var string $status
	 *
	 * What state the job is in. NEW/OWNED/CLOSED/etc.
     *
     * @ORM\Column(name="status", type="string", length=15)
     */
    private $status;

    /**
     * @var date $raisedOn
	 *
	 * When the job was first raised.
     *
     * @ORM\Column(name="raisedOn", type="datetime")
     */
    private $raisedOn;

    /**
     * @var string $raisedBy
	 *
	 * Who or what raised the job, this will usually be 'NebulaFlow' itself.
     *
     * @ORM\Column(name="raisedBy", type="string", length=255)
     */
    private $raisedBy = 'NebulaFlow';

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
     * Set type
     *
     * @param integer $type
     * @return Job
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Job
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Job
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set raisedOn
     *
     * @param date $raisedOn
     * @return Job
     */
    public function setRaisedOn($raisedOn)
    {
        $this->raisedOn = $raisedOn;
        return $this;
    }

    /**
     * Get raisedOn
     *
     * @return date 
     */
    public function getRaisedOn()
    {
        return $this->raisedOn;
    }

    /**
     * Set raisedBy
     *
     * @param string $raisedBy
     * @return Job
     */
    public function setRaisedBy($raisedBy)
    {
        $this->raisedBy = $raisedBy;
        return $this;
    }

    /**
     * Get raisedBy
     *
     * @return string 
     */
    public function getRaisedBy()
    {
        return $this->raisedBy;
    }
}