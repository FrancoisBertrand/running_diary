<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints\ValidDate as ValiDateError;
use App\Validator\Constraints as contError;


/**
 * @ORM\Entity(repositoryClass="App\Repository\RunDiaryRepository")
 */
class RunDiary
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @contError\NegativeDistance
     * @ORM\Column(type="float")
     */
    public $distance;

    /**
     * @ORM\Column(type="datetime")
     */
    public $date;

    /**
     * @ORM\Column(type="float")
     */
    public $avgSpeed;

    /**
     * @contError\ValidDate()
     * @ORM\Column(type="string")
     */
    public $duration;

    /**
     * @var UserData
     * @ORM\ManyToOne(targetEntity="App\Entity\UserData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAvgSpeed()
    {
        return $this->avgSpeed;
    }

    /**
     * @param mixed $avgSpeed
     */
    public function setAvgSpeed($avgSpeed)
    {
        $this->avgSpeed = $avgSpeed;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }



}
