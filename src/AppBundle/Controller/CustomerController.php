<?php

namespace AppBundle\Controller;

use JMS\DiExtraBundle\Annotation as JMS;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as R;
use Symfony\Component\HttpFoundation\Response;

class CustomerController
{
    /**
     * @R\Route("", name="heaven_website_company_ajax_categories_get")
     * @R\Method("GET")
     */
    public function getAction()
    {
        /** @var ResponseContainer $wrapper */
        $wrapper = $this->repository->getAll();
        if ($wrapper->hasError()) {
            $errors = $this->ajaxErrorsExtractor->getErrors($wrapper->getError());
            return new Response(
                $this->serializer->serialize($errors, 'json'),
                $wrapper->getError()->getStatusCode(),
                ["Content-Type" => "application/json"]
            );
        }

        return new Response(
            $this->serializer->serialize(['data' => $wrapper->getData()], 'json'),
            Response::HTTP_OK,
            ["Content-Type" => "application/json"]
        );
    }
}