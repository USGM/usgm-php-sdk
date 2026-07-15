<?php

namespace Usgm\Types;

use Usgm\Core\Json\JsonSerializableType;
use Usgm\Core\Json\JsonProperty;
use Usgm\Core\Types\ArrayType;

class ProblemDetailsDto extends JsonSerializableType
{
    /**
     * @var string $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string $title
     */
    #[JsonProperty('title')]
    public string $title;

    /**
     * @var int $status
     */
    #[JsonProperty('status')]
    public int $status;

    /**
     * @var string $code
     */
    #[JsonProperty('code')]
    public string $code;

    /**
     * @var string $requestId
     */
    #[JsonProperty('request_id')]
    public string $requestId;

    /**
     * @var ?string $detail
     */
    #[JsonProperty('detail')]
    public ?string $detail;

    /**
     * @var ?string $instance
     */
    #[JsonProperty('instance')]
    public ?string $instance;

    /**
     * @var ?array<ProblemDetailsDtoErrorsItem> $errors
     */
    #[JsonProperty('errors'), ArrayType([ProblemDetailsDtoErrorsItem::class])]
    public ?array $errors;

    /**
     * @param array{
     *   type: string,
     *   title: string,
     *   status: int,
     *   code: string,
     *   requestId: string,
     *   detail?: ?string,
     *   instance?: ?string,
     *   errors?: ?array<ProblemDetailsDtoErrorsItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->title = $values['title'];
        $this->status = $values['status'];
        $this->code = $values['code'];
        $this->requestId = $values['requestId'];
        $this->detail = $values['detail'] ?? null;
        $this->instance = $values['instance'] ?? null;
        $this->errors = $values['errors'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
