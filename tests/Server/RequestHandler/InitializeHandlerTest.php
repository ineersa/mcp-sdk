<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\AI\McpSdk\Tests\Server\RequestHandler;

use PHPUnit\Framework\TestCase;
use Symfony\AI\McpSdk\Capability\Server\Implementation;
use Symfony\AI\McpSdk\Capability\Server\ServerCapabilities;
use Symfony\AI\McpSdk\Capability\Tool\ToolCapability;
use Symfony\AI\McpSdk\Message\Request;
use Symfony\AI\McpSdk\Server\RequestHandler\InitializeHandler;

class InitializeHandlerTest extends TestCase
{
    public function testCreateResponse()
    {
        $implementation = new Implementation('TestServer', '1.0.0');
        $serverCapabilities = new ServerCapabilities(
            tools: new ToolCapability(listChanged: true),
            logging: null // Explicitly set to null to test filtering
        );

        $handler = new InitializeHandler(
            $implementation,
            $serverCapabilities,
            '2024-11-05'
        );

        $request = new Request(1, 'initialize', []);
        $response = $handler->createResponse($request);
        $serializedResponse = json_decode(json_encode($response), true);

        $this->assertArrayHasKey('protocolVersion', $serializedResponse['result']);
        $this->assertEquals('2024-11-05', $serializedResponse['result']['protocolVersion']);

        $this->assertArrayHasKey('serverInfo', $serializedResponse['result']);
        $this->assertEquals(['name' => 'TestServer', 'version' => '1.0.0'], $serializedResponse['result']['serverInfo']);

        $this->assertArrayHasKey('capabilities', $serializedResponse['result']);
        $capabilities = $serializedResponse['result']['capabilities'];
        $this->assertArrayHasKey('tools', $capabilities);
        $this->assertTrue($capabilities['tools']['listChanged']);
        $this->assertArrayNotHasKey('logging', $capabilities);
        $this->assertArrayNotHasKey('prompts', $capabilities);
        $this->assertArrayNotHasKey('resources', $capabilities);
        $this->assertArrayNotHasKey('completions', $capabilities);
        $this->assertArrayNotHasKey('experimental', $capabilities);
    }
}
