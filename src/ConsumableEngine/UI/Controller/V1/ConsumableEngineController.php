<?php

namespace Api\ConsumableEngine\UI\Controller\V1;

use Api\ConsumableEngine\Application\Command\NotifyBiologicTestHasBeenLaunchedCommand;
use Api\ConsumableEngine\Application\Exception\BiologicTestNotFoundException;
use Api\ConsumableEngine\UI\Request\Form\Type\NotifyBiologicTestHasBeenLaunchedFormType;
use Api\ConsumableEngine\UI\Response\DataTransferObject\LaunchedBiologicTestPayload;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/v1/consumable")
 */
class ConsumableEngineController extends Controller
{
    /**
     * @Route("/notify/biologic-test-launched.json")
     * @Method("POST")
     */
    public function postNotifyBiologicTestLaunchedAction(Request $request)
    {
        // @hint We declare an empty Command ready to be hydrated from Request using FormType
        $command = new NotifyBiologicTestHasBeenLaunchedCommand();

        // Validate and hydrate Command
        $form = $this->createForm(new NotifyBiologicTestHasBeenLaunchedFormType(), $command);
        $form->handleRequest($request);

         if (false === $form->isValid()) {
            // @hint UI validation failed, no need to enter in the domain yet
            return $this->get('api.common.ui.response.json_response.factory')->createErrorJsonResponseForProperty(
                JsonResponse::HTTP_NOT_ACCEPTABLE,
                (string) $form->getErrors(),
                $form->getErrors()->current()->getOrigin()->getName()
            );
         }

        try {
            // @hint our Application entry point leading to our Domain
            $this->get('api.consumable_engine.application.service')->notifyBiologicTestHasBeenLaunched($command);

            return $this->get('api.common.ui.response.json_response.factory')->createJsonResponseFromJsonSerializable(
                JsonResponse::HTTP_CREATED,
                // @hint We send back what we understood from user intention
                // @hint We are trusting our Application Service to have persisted data
                //       If it would have failed, we would have caught an Exception
                new LaunchedBiologicTestPayload(
                    'LaunchedBiologicTestPayload',
                    $command->biologicTestId,
                    $command->numberOfUsedTube,
                    $command->launchedAtUTC
                )
            );
        } catch (BiologicTestNotFoundException $e) {
            // @hint Application Exception returning 404
            return $this->get('api.common.ui.response.json_response.factory')->createErrorJsonResponseForProperty(
                JsonResponse::HTTP_NOT_FOUND,
                'Biologic Test not found.',
                'biologic_test_id'
            );
        }
    }
}
