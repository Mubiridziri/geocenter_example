<?php

namespace App\Controller;

use Mubiridziri\Geocenter\Model\DecoderContext;
use Mubiridziri\Geocenter\Model\LatLng;
use Mubiridziri\Geocenter\Model\ReverseDecoderContext;
use Mubiridziri\Geocenter\Option\GeodecodeData;
use Mubiridziri\Geocenter\Option\GeodecodeFormat;
use Mubiridziri\Geocenter\Option\GeodecodeType;
use Mubiridziri\Geocenter\Service\GeocenterManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IndexController extends AbstractController
{
    /**
     * Прямое геокодирование
     * @return JsonResponse
     * @Route("/geodecode", methods={"GET"})
     */
    public function geodecodeAction(GeocenterManager $manager)
    {
        $results = $manager->geodecode("Россия, Челябинская область, городской округ Магнитогорский, г Магнитогорск, ул. Рысакова", (new DecoderContext())
            ->setData(GeodecodeData::DATA_ADDRESS)
            ->setFormat(GeodecodeFormat::SIMPLE_FORMAT)
        );
        return $this->json($results);
    }

    /**
     * Обратное геокодирование
     * @return JsonResponse
     * @Route("/reverse", methods={"GET"})
     */
    public function reverseGeodecodeAction(GeocenterManager $manager)
    {
        $results = $manager->reverse(new LatLng('59.0433624', '53.3930438'), (new ReverseDecoderContext())
            ->setFormat(GeodecodeFormat::SIMPLE_FORMAT)
            ->setType(GeodecodeType::ROAD)
        );
        return $this->json($results);
    }
}
