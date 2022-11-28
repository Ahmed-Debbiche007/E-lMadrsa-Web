<?php

namespace App\Services;
use App\Repository\AttestationRepository;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Builder\Builder;

class QrcodeService
{


    public function __construct(BuilderInterface $builder){




    }
    public function Qrcode($query){

        $url = 'Cette Attestation est délivrée à ' ;
        $result = Builder::create()
            ->data($url.$query)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->labelText('Code-Qr')
            ->build()

            ;

        $namePng= uniqid('','') . '.png';
        $result->saveToFile((\dirname(__DIR__,2).'/public/assets/qr-code/'.$namePng));
        return $result->getDataUri();


    }

    public function __toString() {
        return (string) $this->url
        ;}
}