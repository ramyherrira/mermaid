<?php

namespace Tests\Unit;

use Herrira\Mermaid\ClassDiagram\AttributeDefinition;
use PHPUnit\Framework\TestCase;

class AttributeDefinitionTest extends TestCase
{
    public function test_it_generates_an_attribute_with_only_a_name()
    {
        $expression = new AttributeDefinition('attribute_name');

        $this->assertEquals('attribute_name', $expression->generate());
    }

    public function test_it_generates_an_attribute()
    {
        $expression = new AttributeDefinition('height', 'int', '-');

        $this->assertEquals(
            '-int height',
            $expression->generate()
        );
    }

    public function test_it_generates_an_inline_attribute()
    {
        $expression = new AttributeDefinition('age', 'int', '+', 'Dog');

        $this->assertEquals(
            'Dog : +int age',
            $expression->generate()
        );
    }

}