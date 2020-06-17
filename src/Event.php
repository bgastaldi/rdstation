<?php

namespace RDStation;

use RDStation\Exception\Exception;
use RDStation\Exception\UnauthorizedRequest;

/**
 * RD Station API integration for new API version
 *
 * @author Glauber Portella <glauberportella@gmail.com>
 */
class Event
{
    const EVENT_CONVERSION = 'CONVERSION';
    const EVENT_OPPORTUNITY = 'OPPORTUNITY';
    const EVENT_OPPORTUNITY_WON = 'SALE';
    const EVENT_OPPORTUNITY_LOST = 'OPPORTUNITY_LOST';
    const EVENT_ORDER_PLACED = 'ORDER_PLACED';
    const EVENT_ORDER_PLACED_ITEM = 'ORDER_PLACED_ITEM';
    const EVENT_CART_ABANDONED = 'CART_ABANDONED';
    const EVENT_CART_ABANDONED_ITEM = 'CART_ABANDONED_ITEM';
    const EVENT_CHAT_STARTED = 'CHAT_STARTED';
    const EVENT_CHAT_FINISHED = 'CHAT_FINISHED';

    const CDP_FAMILY = 'CDP';

    /**
     * Access token
     *
     * @var AccessToken
     */
    private $accessToken;

    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Standard Event Conversion
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * conversion_identifier            String  true    The name of the conversion event.
     * name	                            String  false   Name of the contact.
     * email                            String  true    Email of the contact.
     * job_title                        String  false   Job title of the contact.
     * state                            String  false   State of the contact.
     * city                             String  false   City of the contact.
     * country                          String  false   Country of the contact.
     * personal_phone                   String  false   Phone of the contact.
     * mobile_phone                     String  false   Mobile phone of the contact.
     * twitter                          String  false   Twitter handler of the contact.
     * facebook                         String  false   Facebook of the contact.
     * linkedin                         String  false   Linkedin of the contact.
     * website                          String  false   Website of the contact.
     * cf_custom_field_api_identifier   String  false   Custom field and its value related to the contact.
     *                                                  All custom fields available in RD Station Marketing account are valid on this payload,
     *                                                  and should be sent with the payload key being the the fields api identifier (cf_api_identifier)
     * company_name                     String  false   Company name of the contact.
     * company_site                     String  false   Company website of the contact.
     * company_address                  String  false   Company address of the contact.
     * client_tracking_id               String  false   LeadTracking client_id
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function conversion(array $payload)
    {
        return $this->sendEvent(self::EVENT_CONVERSION, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Opportunity
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * funnel_name                     String  true     Name of the funnel to which the Contact should be marked as opportunity.
     * email	                       String  true     Email of the contact.
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function opportunity(array $payload)
    {
        return $this->sendEvent(self::EVENT_OPPORTUNITY, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Opportunity Won (Sale)
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * funnel_name                     String  true     Name of the funnel to which the Contact should be marked as won.
     * email	                       String  true     Email of the contact.
     * value                           String  false    Value of the won opportunity.
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function opportunityWon(array $payload)
    {
        return $this->sendEvent(self::EVENT_OPPORTUNITY_WON, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Opportunity lost
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * funnel_name                     String  true     Name of the funnel to which the Contact should be marked as lost.
     * email                           String  true     Lead email
     * reason                          String  false    Reason for why the Contact was marked as lost.
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function opportunityLost(array $payload)
    {
        return $this->sendEvent(self::EVENT_OPPORTUNITY_LOST, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Order placed
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * cf_order_id                      String  true    Order identifier
     * name                             String  false   Name of the contact.
     * email                            String  true    Email of the contact.
     * cf_order_total_items             Integer false   Total number of itens from the order.
     * cf_order_status                  String  false   Status of the order to when the event was triggered
     * cf_order_payment_method          String  false   Method of payment. Available options: "Credit Card", "Debit Card", "Invoice", "Others"
     * cf_order_payment_amount          String  false   Total value of the order
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function orderPlaced(array $payload)
    {
        return $this->sendEvent(self::EVENT_ORDER_PLACED, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Order placed item
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * cf_order_id                      String  true    Order identifier
     * name                             String  false   Name of the contact.
     * email                            String  true    Email of the contact.
     * cf_order_product_id              String  true    Product Identifier
     * cf_order_product_sku             String  false   Product SKU
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function orderPlacedItem(array $payload)
    {
        return $this->sendEvent(self::EVENT_ORDER_PLACED_ITEM, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Cart abandoned
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * cf_cart_id                       String  true    Cart identifier
     * name                             String  false   Name of the contact.
     * email                            String  true    Email of the contact.
     * cf_cart_total_items              Integer false   Total number of itens from the cart.
     * cf_cart_status                   String  false   Status of the cart to when the event was triggered
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function cartAbandoned(array $payload)
    {
        return $this->sendEvent(self::EVENT_CART_ABANDONED, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Cart item abandoned
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * cf_cart_id                       String	true	Cart identifier
     * name                             String	false	Name of the contact.
     * email                            String	true	Email of the contact.
     * cf_cart_product_id               String	true	Identifier of the product that was left on the cart.
     * cf_cart_product_sku              String	false	SKU of the product that was left on the cart
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function cartAbandonedItem(array $payload)
    {
        return $this->sendEvent(self::EVENT_CART_ABANDONED_ITEM, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Chat started
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * chat_subject                     String  true    The subject of the chat.
     * name                             String  false   Name of the contact.
     * email                            String  true    Email of the contact.
     * job_title                        String  false   Job title of the contact.
     * personal_phone                   String  false   Phone of the contact.
     * mobile_phone                     String  false   Mobile phone of the contact.
     * twitter                          String  false   Twitter handler of the contact.
     * facebook                         String  false   Facebook of the contact.
     * linkedin                         String  false   Linkedin of the contact.
     * website                          String  false   Website of the contact.
     * cf_birthdate                     String  false   Bith date of the Contact
     * cf_gender                        String  false   Gender of the Contact.
     * chat_status                      String  false   Status of the chat.
     * chat_type                        String  false   Type of the chat.
     * company_site                     String  false   Company website of the contact.
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function chatStarted(array $payload)
    {
        return $this->sendEvent(self::EVENT_CHAT_STARTED, self::CDP_FAMILY, $payload);
    }

    /**
     * Standard Event Chat finished
     *
     * PAYLOAD FIELD NAMES             TYPE    REQ.
     * --------------------------------------------------------------------------------
     * chat_subject                     String  true    The subject of the chat.
     * name                             String  false   Name of the contact.
     * email                            String  true    Email of the contact.
     * job_title                        String  false   Job title of the contact.
     * personal_phone                   String  false   Phone of the contact.
     * mobile_phone                     String  false   Mobile phone of the contact.
     * twitter                          String  false   Twitter handler of the contact.
     * facebook                         String  false   Facebook of the contact.
     * linkedin                         String  false   Linkedin of the contact.
     * website                          String  false   Website of the contact.
     * cf_birthdate                     String  false   Bith date of the Contact
     * cf_gender                        String  false   Gender of the Contact.
     * chat_status                      String  false   Status of the chat.
     * chat_type                        String  false   Type of the chat.
     * company_site                     String  false   Company website of the contact.
     *
     * @param array $payload
     * @return array JSON respone as array
     */
    public function chatFinished(array $payload)
    {
        return $this->sendEvent(self::EVENT_CHAT_FINISHED, self::CDP_FAMILY, $payload);
    }

    /**
     * Send a general RD Station event
     *
     * @param string $eventType
     * @param string $eventFamily
     * @param array $payload
     * @return array JSON response as array
     */
    public function sendEvent($eventType, $eventFamily, array $payload)
    {
        $fields = [
            'event_type' => $eventType,
            'event_family' => $eventFamily,
            'payload' => $payload
        ];

        try {
            $response = Request::send('POST', '/platform/events', $fields, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->accessToken->getToken()
            ]);
        } catch (UnauthorizedRequest $e) {
            // invalid access token? refresh and try again
            if ($e->hasErrorType(Exception::TYPE_UNAUTHORIZED)) {
                $this->accessToken->refresh();
                $response = Request::send('POST', '/platform/events', $fields, [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->accessToken->getToken()
                ]);
            } else {
                throw $e;
            }
        }

        return json_decode($response, true);
    }

}
