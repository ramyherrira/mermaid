<?php

namespace Herrira\Mermaid\ClassDiagram;

class RelationDefinition
{
    protected $type;

    protected $classA;

    protected $classB;

    const SYMBOLS = [
        'inheritance' => '--|>',
        'composition' => '--*',
        'aggregation'  => '--o',
        'association' => '-->',
        'link' => '--',
        'dependency' => '..>',
        'realization' => '..|>',
        'dashedLink' => '..',
    ];

    public function __construct($type, $classA, $classB)
    {
        $this->type = $type;
        $this->classA = $classA;
        $this->classB = $classB;
    }

    public function generate(): string
    {
        $symbol = self::SYMBOLS[$this->type];

        return "{$this->classA} {$symbol} {$this->classB}";
    }
}