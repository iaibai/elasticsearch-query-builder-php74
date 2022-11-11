<?php

namespace Spatie\ElasticsearchQueryBuilder\Queries;

class MatchQuery implements Query
{
    protected string $field;

    /**
     * @var string|int $query
     */
    protected $query;

    /**
     * @var string|int|null $fuzziness
     */
    protected $fuzziness = null;

    /**
     * @param string $field
     * @param string|int $query
     * @param string|int|null $fuzziness
     * @return static
     */
    public static function create(
        string $field,
        $query,
        $fuzziness = null
    ): self {
        return new self($field, $query, $fuzziness);
    }

    public function __construct(
        string $field,
        $query,
        $fuzziness = null
    ) {
        $this->field = $field;
        $this->query = $query;
        $this->fuzziness = $fuzziness;
    }

    public function toArray(): array
    {
        $match = [
            'match' => [
                $this->field => [
                    'query' => $this->query,
                ],
            ],
        ];

        if ($this->fuzziness) {
            $match['match'][$this->field]['fuzziness'] = $this->fuzziness;
        }

        return $match;
    }
}
