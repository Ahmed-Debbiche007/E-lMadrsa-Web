<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages
 *
 * @ORM\Table(name="messages")
 * @ORM\Entity
 */
class Messages
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMessage", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmessage;

    /**
     * @var int
     *
     * @ORM\Column(name="idSession", type="bigint", nullable=false)
     */
    private $idsession;

    /**
     * @var int
     *
     * @ORM\Column(name="idSender", type="bigint", nullable=false)
     */
    private $idsender;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", length=65535, nullable=false)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="statusDate", type="datetime", nullable=false)
     */
    private $statusdate;


}
