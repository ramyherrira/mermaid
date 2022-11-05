<?php

namespace Tests\Unit;

use Herrira\Mermaid\ClassDiagram\Builder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function test_generates_empty_diagram()
    {
        $builder = $this->createBuilder();

        $this->assertEquals("classDiagram\n", $builder->generate());
    }

    public function test_generates_class()
    {
        $builder = $this->createBuilder();

        $builder->class('Dog');

        $this->assertEquals("classDiagram\nclass Dog\n", $builder->generate());
    }

    public function test_generate_class_with_attributes()
    {
        $builder = $this->createBuilder();

        $builder->class('Dog')
            ->publicAttribute('Dog', 'age', 'int')
            ->protectedAttribute('Dog', 'gender', 'string')
            ->privateAttribute('Dog', 'weight', 'float')
            ->attribute('Dog', 'isGoodBoy', 'boolean');

        $this->assertEquals(
            "classDiagram\n" .
            "class Dog\n" .
            "Dog : +int age\n" .
            "Dog : #string gender\n" .
            "Dog : -float weight\n" .
            "Dog : boolean isGoodBoy\n",
            $builder->generate()
        );
    }

    public function test_generate_class_within_closure()
    {
        $builder = $this->createBuilder();

        $builder->class(function ($class) {
            $class->name('Dog')
                ->publicAttribute('age', 'int')
                ->protectedAttribute('gender', 'string');
        });

        $this->assertEquals(
            "classDiagram\n" .
            "class Dog {\n" .
            "+int age\n" .
            "#string gender\n" .
            "}\n",
            $builder->generate()
        );
    }

    public function test_generate_assocation_relationtions()
    {
        $builder = $this->createBuilder();

        $builder->association('ClassA', 'ClassB');

        $this->assertEquals(
            "classDiagram\nClassA --> ClassB\n",
            $builder->generate()
        );
    }

    public function test_generate_class_with_annotation()
    {
        $builder = $this->createBuilder();

        $builder->class('Animal')
            ->annotation('Animal', 'interface');

        $this->assertEquals(
            "classDiagram\nclass Animal\n<<interface>> Animal\n",
            $builder->generate()
        );
    }

    public function test_generate_class_method()
    {
        $builder = $this->createBuilder();

        $builder->class('Dog')
            ->method('Dog', 'bark');

        $this->assertEquals(
            "classDiagram\nclass Dog\nDog: bark()\n",
            $builder->generate()
        );
    }

    public function test_generate_class_method_with_parameters()
    {
        $builder = $this->createBuilder();

        $builder->class('Dog')
            ->method('Dog', 'chew', ['bone', 'int minutes']);

        $this->assertEquals(
            "classDiagram\nclass Dog\nDog: chew(bone, int minutes)\n",
            $builder->generate()
        );
    }

    public function test_generate_class_method_with_return_type()
    {
        $builder = $this->createBuilder();

        $builder->class('Dog')
            ->method('Dog', 'isHappy', [], 'bool');

        $this->assertEquals(
            "classDiagram\nclass Dog\nDog: isHappy() bool\n",
            $builder->generate()
        );
    }

    public function test_generate_class_public_method()
    {
        $builder = $this->createBuilder();
        $builder->class('Dog')
            ->publicMethod('Dog', 'sleep', [], 'bool');

        $this->assertEquals(
            "classDiagram\nclass Dog\nDog: +sleep() bool\n",
            $builder->generate()
        );
    }

    public function test_generate_class_protected_method()
    {
        $builder = $this->createBuilder();
        $builder->class('Dog')
            ->protectedMethod('Dog', 'prepare', [], 'bool');

        $this->assertEquals(
            "classDiagram\nclass Dog\nDog: #prepare() bool\n",
            $builder->generate()
        );
    }

    public function test_generate_class_private_method()
    {
        $builder = $this->createBuilder();
        $builder->class('Dog')
            ->privateMethod('Dog', 'prepare', [], 'bool');

        $this->assertEquals(
            "classDiagram\nclass Dog\nDog: -prepare() bool\n",
            $builder->generate()
        );
    }

    /**
     * @return Builder
     */
    protected function createBuilder(): Builder
    {
        return new Builder();
    }
}
