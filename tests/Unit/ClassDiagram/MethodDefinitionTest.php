<?php

namespace Tests\Unit\ClassDiagram;

use Herrira\Mermaid\ClassDiagram\MethodDefinition;
use \PHPUnit\Framework\TestCase;

class MethodDefinitionTest extends TestCase
{
    public function test_generate_method()
    {
        $expression = new MethodDefinition('quack');

        $this->assertEquals('quack()', $expression->generate());
    }

    public function test_generate_method_with_attributes()
    {
        $expression = new MethodDefinition('chew', ['shoe', 'duration']);

        $this->assertEquals('chew(shoe, duration)', $expression->generate());
    }

    public function test_generate_method_with_return_type()
    {
        $expression = new MethodDefinition('bark', [], 'boolean');

        $this->assertEquals('bark() boolean', $expression->generate());
    }

    public function test_generate_method_with_visibility()
    {
        $expression = new MethodDefinition('fly', ['x', 'y', 'z'], null, '+');

        $this->assertEquals('+fly(x, y, z)', $expression->generate());
    }
}