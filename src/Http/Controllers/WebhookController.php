<?php

declare(strict_types=1);

namespace Phalcon\Cashier\Controllers;

use Phalcon\Http\Response;
use App\Models\Users;
use Gewaer\Exception\NotFoundHttpException;
use Baka\Http\Rest\CrudExtendedController;
use Datetime;

/**
 * Class PaymentsController
 *
 * Class to handle payment webhook from our cashier library
 *
 * @package Gewaer\Api\Controllers
 * @property Log $log
 *
 */
class WebhookController extends CrudExtendedController
{
    /**
     * Handle stripe webhoook calls
     *
     * @return Response
     */
    public function handleWebhook(): Response
    {
        //we cant processs if we dont find the stripe header
        if (!defined('API_TESTS')) {
            if (!$this->request->hasHeader('Stripe-Signature')) {
                throw new NotFoundHttpException('Route not found for this call');
            }
        }

        $request = $this->request->getPost();

        if (empty($request)) {
            $request = $this->request->getJsonRawBody(true);
        }
        $type = str_replace('.', '', ucwords(str_replace('_', '', $request['type']), '.'));
        $method = 'handle' . $type;

        $payloadContent = json_encode($request);
        $this->log->info("Webhook Handler Method: {$method} \n");
        $this->log->info("Payload: {$payloadContent} \n");

        if (method_exists($this, $method)) {
            return $this->{$method}($request);
        } else {
            return $this->response(['Missing Method to Handled']);
        }
    }

    /**
     * Handle customer subscription updated.
     *
     * @param  array $payload
     * @return String
     */
    public function handleCustomerSubscriptionUpdated(array $payload): String
    {
        $user = Users::findFirstByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $subject = "{$user->firstname} {$user->lastname} Updated Subscription";
            $content = "Dear user {$user->firstname} {$user->lastname}, your subscription has been updated.";

            $template = [
                        'subject' => $subject,
                        'content' => $content
                    ];
            //We need to send a mail to the user
            // if (!defined('API_TESTS')) {
            //     $this->sendWebhookEmail($user->email, $template);
            // }
            return 'Webhook Handled';
        }
    }

    /**
     * Handle customer subscription free trial ending.
     *
     * @param  array $payload
     * @return String
     */
    public function handleCustomerSubscriptionTrialwillend(array $payload): String
    {
        $trialEndDate = new Datetime();
        $trialEndDate->setTimestamp((int)$payload['data']['object']['trial_end']);
        $formatedEndDate = $trialEndDate->format('Y-m-d H:i:s');

        $user = Users::findFirstByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $subject = "{$user->firstname} {$user->lastname} Free Trial Ending";
            $content = "Dear user {$user->firstname} {$user->lastname}, your free trial is coming to an end on {$formatedEndDate}.Please choose one of our available subscriptions. Thank you";

            $template = [
                'subject' => $subject,
                'content' => $content
            ];
            //We need to send a mail to the user
            // if (!defined('API_TESTS')) {
            //     $this->sendWebhookEmail($user->email, $template);
            // }

            return 'Webhook Handled';
        }
    }

    /**
     * Handle sucessfull payment
     *
     * @todo send email
     * @param array $payload
     * @return String
     */
    public function handleChargeSucceeded(array $payload): String
    {
        $user = Users::findFirstByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $subject = "{$user->firstname} {$user->lastname} Successful Payment";
            $content = "Dear user {$user->firstname} {$user->lastname}, your subscription payment of {$payload['data']['object']['amount']} was successful. Thank you";

            $template = [
                'subject' => $subject,
                'content' => $content
            ];
            //We need to send a mail to the user
            // if (!defined('API_TESTS')) {
            //     $this->sendWebhookEmail($user->email, $template);
            // }

            return 'Webhook Handled';
        }
    }

    /**
     * Handle bad payment
     *
     * @todo send email
     * @param array $payload
     * @return String
     */
    public function handleChargeFailed(array $payload) : String
    {
        $user = Users::findFirstByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $subject = "{$user->firstname} {$user->lastname} Failed Payment";
            $content = "Dear user {$user->firstname} {$user->lastname}, your subscription presents a failed payment of the amount of {$payload['data']['object']['amount']}. Please check card expiration date";

            $template = [
                'subject' => $subject,
                'content' => $content
            ];
            //We need to send a mail to the user
            // if (!defined('API_TESTS')) {
            //     $this->sendWebhookEmail($user->email, $template);
            // }

            return 'Webhook Handled';
        }
    }

    /**
     * Handle pending payments
     *
     * @todo send email
     * @param array $payload
     * @return String
     */
    public function handleChargePending(array $payload) : String
    {
        $user = Users::findFirstByStripeId($payload['data']['object']['customer']);
        if ($user) {
            $subject = "{$user->firstname} {$user->lastname} Pending Payment";
            $content = "Dear user {$user->firstname} {$user->lastname}, your subscription presents a pending payment of {$payload['data']['object']['amount']}";

            $template = [
                'subject' => $subject,
                'content' => $content
            ];
            //We need to send a mail to the user
            // if (!defined('API_TESTS')) {
            //     $this->sendWebhookEmail($user->email, $template);
            // }

            return 'Webhook Handled';
        }
    }
}
