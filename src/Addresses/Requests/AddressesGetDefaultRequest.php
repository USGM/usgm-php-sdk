<?php

namespace Usgm\Addresses\Requests;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Addresses\Types\AddressesGetDefaultRequestType;

class AddressesGetDefaultRequest extends JsonSerializableType
{
    /**
     * @var value-of<AddressesGetDefaultRequestType> $type `shipping` = a shipment destination; `deposit` = where check deposits are sent.
     */
    public string $type;

    /**
     * @param array{
     *   type: value-of<AddressesGetDefaultRequestType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
    }
}
