<?php
namespace FedEx\OpenShipService\SimpleType;

use FedEx\AbstractSimpleType;

/**
 * EMailNotificationRecipientType
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  OpenShip Service
 */
class EMailNotificationRecipientType extends AbstractSimpleType
{
    const _BROKER = 'BROKER';
    const _OTHER = 'OTHER';
    const _RECIPIENT = 'RECIPIENT';
    const _SHIPPER = 'SHIPPER';
    const _THIRD_PARTY = 'THIRD_PARTY';
}
