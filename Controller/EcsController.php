<?php

namespace UAM\Bundle\AwsEcsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use UAM\Bundle\AwsEcsBundle\Form\Type\ItemSearchType;

class EcsController extends Controller
{
    /**
     * @Route("/search", name="uam_aws_ecs_item_search")
     * @template()
     */
    public function itemSearchAction(Request $request)
    {
        $stores = $this->container->getParameter('uam_aws_ecs')['stores'];

        $form = $this->createForm(new ItemSearchType($stores));

        return array(
            'form' => $form->createView(),
            'stores' => $stores
        );
    }


    /**
     * @Route("/debug", name="uam_aws_ecs_debug")
     * @Template()
     */
    public function debugAction(Request $request)
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