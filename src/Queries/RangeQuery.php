<?php

namespace Spatie\ElasticsearchQueryBuilder\Queries;

class RangeQuery implements Query
{
    protected string $field;

    /** @var int|float|string|null $gte */
    protected $gte = null;

    /** @var int|float|string|null $lt */
    protected $lt = null;

    /** @var int|float|string|null $lte */
    protected $lte = null;

    /** @var int|float|string|null $gt */
    protected $gt = null;

    public static function create(string $field): self
    {
        return new self($field);
    }

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * @param int|float|string $value
     */
    public function lt($value): self
    {
        $this->lt = $value;

        return $this;
    }

    /**
     * @param int|float|string $value
     */
    public function lte($value): self
    {
        $this->lte = $value;

        return $this;
    }

    /**
     * @param int|float|string $value
     * @return $this
     */
    public function gt($value): self
    {
        $this->gt = $value;

        return $this;
    }

    /**
     * @param int|float|string $value
     * @return $this
     */
    public function gte($value): self
    {
        $this->gte = $value;

        return $this;
    }

    public function toArray(): array
    {
        $parameters = [];

        if ($this->lt !== null) {
            $parameters['lt'] = $this->lt;
        }

        if ($this->lte !== null) {
            $parameters['lte'] = $this->lte;
        }

        if ($this->gt !== null) {
            $parameters['gt'] = $this->gt;
        }

        if ($this->gte !== null) {
            $parameters['gte'] = $this->gte;
        }

        return [
            'range' => [
                $this->field => $parameters,
            ],
        ];
    }
}
