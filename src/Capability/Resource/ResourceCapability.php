<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\AI\McpSdk\Capability\Resource;

final readonly class ResourceCapability
{
    public function __construct(
        public ?bool $subscribe = null,
        public ?bool $listChanged = null,
    ) {
    }
}
