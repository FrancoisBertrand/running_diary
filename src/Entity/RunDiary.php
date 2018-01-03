<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="float")
     */
    private $distance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $avgSpeed;

    /**
     * @ORM\Column(type="string")
     */
    private $avgTime;

    /**
     * @ORM\Column(type="string")
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
    public function getAvgTime()
    {
        return $this->avgTime;
    }

    /**
     * @param mixed $avgTime
     */
    public function setAvgTime($avgTime)
    {
        $this->avgTime = $avgTime;
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
