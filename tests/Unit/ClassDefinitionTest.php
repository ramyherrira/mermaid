<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Herrira\Mermaid\ClassDiagram\ClassDefinition as ClassSchema;

class ClassDefinitionTest extends TestCase
{
    public function test_generate_empty_class()
    {
        $schema = $this->createSchema('Dog');

        $this->assertEquals("class Dog\n", $schema->generate());
    }

    public function test_generate_class_with_attributes()
    {
        $schema = $this->createSchema();

        $schema->name('Dolphin')
            ->attribute('age', 'int')
            ->privateAttribute('weight', 'float')
            ->publicAttribute('speed', 'int')
            ->protectedAttribute('isSelected', 'boolean');

        $this->assertEquals(
            "class Dolphin {\n".
            "int age\n".
            "-float weight\n".
            "+int speed\n".
            "#boolean isSelected\n".
            "}\n",
            $schema->generate()
        );
    }

    public function test_generate_class_with_method()
    {
        $schema = $this->createSchema('Rabbit');

        $markdown = $schema->method('eat')
            ->generate();

        $this->assertEquals("class Rabbit {\neat()\n}\n", $markdown);
    }

    public function test_generate_public_method()
    {
        $schema = $this->createSchema('Wolf');

        $markdown = $schema->publicMethod('hunt', ['Animal animal'])
            ->publicMethod('howls', ['seconds'], 'bool')
            ->generate();

        $this->assertEquals(
            "class Wolf {\n".
            "+hunt(Animal animal)\n".
            "+howls(seconds) bool\n".
            "}\n",
            $markdown
        );
    }

    public function test_generate_protected_method()
    {
        $schema = $this->createSchema('Wolf');

        $markdown = $schema->protectedMethod('track', [], 'int')
            ->generate();

        $this->assertEquals("class Wolf {\n#track() int\n}\n", $markdown);
    }

    public function test_generate_private_method()
    {
        $schema = $this->createSchema('Wolf');

        $markdown = $schema->privateMethod('think', [], 'bool')
            ->generate();

        $this->assertEquals("class Wolf {\n-think() bool\n}\n", $markdown);
    }

    public function test_generate_annotation()
    {
        $schema = $this->createSchema('Flamingo');

        $markdown = $schema->annotation('interface')
            ->generate();

        $this->assertEquals("class Flamingo {\n<<interface>>\n}\n", $markdown);
    }

    /**
     * @param $name
     * @return ClassSchema
     */
    public function createSchema($name = ''): ClassSchema
    {
        return new ClassSchema($name);
    }
}