<?php

namespace Tests\Unit\ClassDiagram;

use Herrira\Mermaid\ClassDiagram\RelationDefinition;
use PHPUnit\Framework\TestCase;

class RelationDefinitionTest extends TestCase
{
    /** @dataProvider relationsProvider */
    public function test_all_relations($type, $symbol)
    {
        $relation = new RelationDefinition($type, 'ClassA', 'ClassB');

        $this->assertEquals(
            "ClassA {$symbol} ClassB",
            $relation->generate()
        );
    }

    protected function relationsProvider(): array
    {
        return [
            'inheritance' => ['inheritance', '--|>'],
            'composition' => ['composition', '--*'],
            'aggregation' => ['aggregation', '--o'],
            'association' => ['association', '-->'],
            'link' => ['link', '--'],
            'dependency' => ['dependency', '..>'],
            'realization' => ['realization', '..|>'],
            'dashedLink' => ['dashedLink', '..'],
        ];
    }
}
