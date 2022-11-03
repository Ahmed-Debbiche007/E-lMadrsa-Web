<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Requests
 *
 * @ORM\Table(name="requests")
 * @ORM\Entity
 */
class Requests
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRequest", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrequest;

    /**
     * @var int
     *
     * @ORM\Column(name="idTutor", type="bigint", nullable=false)
     */
    private $idtutor;

    /**
     * @var int
     *
     * @ORM\Column(name="idStudent", type="bigint", nullable=false)
     */
    private $idstudent;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=255, nullable=false)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;


}
