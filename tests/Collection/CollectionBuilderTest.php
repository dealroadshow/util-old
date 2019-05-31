<?php

namespace Granule\Tests\Util\Collection;

use Granule\Tests\Util\Collection\_fixtures\DateCollection;
use Granule\Util\Collection\{ArrayCollection, CollectionBuilder};
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @group collection
 * @coversDefaultClass CollectionBuilder
 */
class CollectionBuilderTest extends TestCase {

    const COLLECTION_CLASS = DateCollection::class;
    /** @var CollectionBuilder */
    private $builder;
    /** @var ArrayCollection */
    private $collection;

    public function provider(): array {
        return [
            [
                'first' => new \DateTimeImmutable('14-01-2014'),
                'second' => new \DateTimeImmutable('12-11-2011'),
                'third' => new \DateTimeImmutable('17-12-2017')
            ]
        ];
    }

    /**
     * @covers ::add
     * @test
     * @dataProvider provider
     *
     * @param $fixture
     *
     * @throws \TypeError
     */
    public function it_should_be_able_to_add_elements($fixture) {

        foreach ($this->collection as $item) {
            $this->builder->add($item);
        }

        $this->assertEquals($this->builder->build(), $this->collection);
    }

    /**
     * @covers ::addBulk
     * @test
     * @dataProvider provider
     *
     * @param $fixture
     */
    public function it_should_be_able_to_bulk_add_elements_from_same_type_collection($fixture) {

        $this->builder->addBulk($this->collection);

        $this->assertEquals($this->builder->build(), $this->collection);
    }

    /**
     * @covers ::add
     * @test
     */
    public function it_should_throw_exception_when_add_item_of_type_diff_from_declared() {

        $this->expectException(\TypeError::class);

        $this->builder->add(new \DateTime());
    }


    /**
     * @dataProvider provider
     */
    protected function setUp() {
        parent::setUp();
        $fixture = $this->getProvidedData();

        $this->builder = (self::COLLECTION_CLASS)::builder();
        $this->collection = (self::COLLECTION_CLASS)::fromArray($fixture);
    }
}