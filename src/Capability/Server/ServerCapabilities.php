<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\AI\McpSdk\Capability\Server;

use Symfony\AI\McpSdk\Capability\Completion\CompletionCapability;
use Symfony\AI\McpSdk\Capability\Logging\LoggingCapability;
use Symfony\AI\McpSdk\Capability\Prompt\PromptCapability;
use Symfony\AI\McpSdk\Capability\Resource\ResourceCapability;
use Symfony\AI\McpSdk\Capability\Tool\ToolCapability;

/**
 * https://modelcontextprotocol.io/specification/2025-06-18/schema#servercapabilities
 */
final readonly class ServerCapabilities
{
    /**
     * @param array<string, array<string, mixed>>|null $experimental
     */
    public function __construct(
        public ?LoggingCapability    $logging = null,
        public ?PromptCapability     $prompts = null,
        public ?ResourceCapability   $resources = null,
        public ?ToolCapability       $tools = null,
        public ?CompletionCapability $completions = null,
        public ?array                $experimental = null,
    ) {
    }

}
