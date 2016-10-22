<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BreakdownRepository")
 */
class Breakdown
{



    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\BoringMachine", mappedBy="breakdown")
     */
    private $boringMachine;



    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id")
     */
    private $creator;

    /**
     * @var datetime
     *
     * @ORM\Column(name="start", type="datetime",nullable=true)
     */
    private $start;

    /**
     * @var datetime
     *
     * @ORM\Column(name="stop", type="datetime",nullable=true)
     */
    private $stop;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notFinished", type="boolean",nullable=true)
     */
    private $notFinished;

    /**
     * @var boolean
     *
     * @ORM\Column(name="closed", type="boolean",nullable=true)
     */
    private $closed;



    /**
     * @var datetime
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;


    /**
     * @ORM\ManyToMany(targetEntity="Descriptor", inversedBy="breakdowns")
     * @ORM\JoinTable(name="breakdowns_descriptors")
     */
    private $descriptors;



    /**
     * @ORM\OneToMany(targetEntity="BreakdownsInterferos", mappedBy="breakdown")
     */
    protected $breakdowns_interferos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->descriptors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->breakdowns_interferos = new \Doctrine\Common\Collections\ArrayCollection();
    }



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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Breakdown
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set stop
     *
     * @param \DateTime $stop
     *
     * @return Breakdown
     */
    public function setStop($stop)
    {
        $this->stop = $stop;

        return $this;
    }

    /**
     * Get stop
     *
     * @return \DateTime
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * Set notFinished
     *
     * @param boolean $notFinished
     *
     * @return Breakdown
     */
    public function setNotFinished($notFinished)
    {
        $this->notFinished = $notFinished;

        return $this;
    }

    /**
     * Get notFinished
     *
     * @return boolean
     */
    public function getNotFinished()
    {
        return $this->notFinished;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return Breakdown
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Breakdown
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add boringMachine
     *
     * @param \AppBundle\Entity\BoringMachine $boringMachine
     *
     * @return Breakdown
     */
    public function addBoringMachine(\AppBundle\Entity\BoringMachine $boringMachine)
    {
        $this->boringMachine[] = $boringMachine;

        return $this;
    }

    /**
     * Remove boringMachine
     *
     * @param \AppBundle\Entity\BoringMachine $boringMachine
     */
    public function removeBoringMachine(\AppBundle\Entity\BoringMachine $boringMachine)
    {
        $this->boringMachine->removeElement($boringMachine);
    }

    /**
     * Get boringMachine
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBoringMachine()
    {
        return $this->boringMachine;
    }

    /**
     * Set creator
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return Breakdown
     */
    public function setCreator(\AppBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Add descriptor
     *
     * @param \AppBundle\Entity\Descriptor $descriptor
     *
     * @return Breakdown
     */
    public function addDescriptor(\AppBundle\Entity\Descriptor $descriptor)
    {
        $this->descriptors[] = $descriptor;

        return $this;
    }

    /**
     * Remove descriptor
     *
     * @param \AppBundle\Entity\Descriptor $descriptor
     */
    public function removeDescriptor(\AppBundle\Entity\Descriptor $descriptor)
    {
        $this->descriptors->removeElement($descriptor);
    }

    /**
     * Get descriptors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDescriptors()
    {
        return $this->descriptors;
    }

    /**
     * Add breakdownsInterfero
     *
     * @param \AppBundle\Entity\BreakdownsInterferos $breakdownsInterfero
     *
     * @return Breakdown
     */
    public function addBreakdownsInterfero(\AppBundle\Entity\BreakdownsInterferos $breakdownsInterfero)
    {
        $this->breakdowns_interferos[] = $breakdownsInterfero;

        return $this;
    }

    /**
     * Remove breakdownsInterfero
     *
     * @param \AppBundle\Entity\BreakdownsInterferos $breakdownsInterfero
     */
    public function removeBreakdownsInterfero(\AppBundle\Entity\BreakdownsInterferos $breakdownsInterfero)
    {
        $this->breakdowns_interferos->removeElement($breakdownsInterfero);
    }

    /**
     * Get breakdownsInterferos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBreakdownsInterferos()
    {
        return $this->breakdowns_interferos;
    }
}
