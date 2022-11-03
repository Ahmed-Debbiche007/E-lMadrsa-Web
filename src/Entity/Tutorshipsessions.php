<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tutorshipsessions
 *
 * @ORM\Table(name="tutorshipSessions")
 * @ORM\Entity
 */
class Tutorshipsessions
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSession", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsession;

    /**
     * @var int
     *
     * @ORM\Column(name="idStudent", type="bigint", nullable=false)
     */
    private $idstudent;

    /**
     * @var int
     *
     * @ORM\Column(name="idTutor", type="bigint", nullable=false)
     */
    private $idtutor;

    /**
     * @var int
     *
     * @ORM\Column(name="idRequest", type="bigint", nullable=false)
     */
    private $idrequest;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;


}
