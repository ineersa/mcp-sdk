<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\AI\McpSdk\Message;

final readonly class Response implements \JsonSerializable
{
    /**
     * @param array<string, mixed> $result
     */
    public function __construct(
        public string|int $id,
        public array $result = [],
    ) {
    }

    /**
     * @return array{jsonrpc: string, id: string|int, result: array<string, mixed>}
     */
    public function jsonSerialize(): array
    {
        return [
            'jsonrpc' => '2.0',
            'id' => $this->id,
            'result' => self::removeNullValues($this->result),
        ];
    }

    /**
     * @param array<mixed> $data
     *
     * @return array<mixed>
     */
    private static function removeNullValues(array $data): array
    {
        foreach ($data as &$value) {
            if (\is_array($value)) {
                $value = self::removeNullValues($value);
            }
        }

        return array_filter($data, fn ($value) => null !== $value);
    }
}
