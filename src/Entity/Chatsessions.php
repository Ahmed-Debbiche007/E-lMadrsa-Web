<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chatsessions
 *
 * @ORM\Table(name="chatSessions", uniqueConstraints={@ORM\UniqueConstraint(name="idTutorshipSession", columns={"idTutorshipSession"})})
 * @ORM\Entity
 */
class Chatsessions
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
     * @ORM\Column(name="idTutorshipSession", type="bigint", nullable=false)
     */
    private $idtutorshipsession;


}
