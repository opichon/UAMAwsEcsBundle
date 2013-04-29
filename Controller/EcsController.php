<?php

namespace UAM\Bundle\AwsEcsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class EcsController extends Controller
{
    /**
     * @Route("/search", name="uam_aws_ecs_itemsearch")
     * @Template()
     */
    public function itemSearchAction(Request $request)
    {
        $client = $this->get('amazon_fr');
        $command = $client->getCommand(
            'ItemSearch',
            array(
                'SearchIndex' => 'Book',
                'Keywords' => 'Daniel Porot',
                'ResponseGroup' => 'Small'
            )
        );

        $command->prepare();
        $request = $command->getRequest();

        $params = $command->getOperation()->getParams();
        
        $service_description = $client->getDescription();
        $operations = $service_description->getOperations();

        $operation = $command->getOperation();

        $parameters = $operation->getParams();

        $results = $command->execute();

        // $items = $results->getItems();

        return array(
            'client' => $client,
            'class' => get_class($results),
            'request' => $request,
            'params' => $params,
            'service_description' => $client->getDescription()->serialize(),
            'operations' => array_keys($operations),
            'results' => $command->execute()
        );
    }
}