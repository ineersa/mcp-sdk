<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\AI\McpSdk\Server\RequestHandler;

use Symfony\AI\McpSdk\Capability\Server\Implementation;
use Symfony\AI\McpSdk\Capability\Server\ServerCapabilities;
use Symfony\AI\McpSdk\Message\Request;
use Symfony\AI\McpSdk\Message\Response;

final class InitializeHandler extends BaseRequestHandler
{
    public function __construct(
        private readonly Implementation $implementation,
        private readonly ServerCapabilities $serverCapabilities,
        private readonly string $protocolVersion = '2025-03-26',
    ) {
    }

    public function createResponse(Request $message): Response
    {
        return new Response($message->id, [
            'protocolVersion' => $this->protocolVersion,
            'capabilities' => $this->serverCapabilities,
            'serverInfo' => $this->implementation,
        ]);
    }

    protected function supportedMethod(): string
    {
        return 'initialize';
    }
}
