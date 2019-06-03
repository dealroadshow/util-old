<?php

namespace Granule\Tests\Util\Collection;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use Granule\Tests\Util\Collection\_fixtures\{DateCollection, DateIntervalCollection};
use Granule\Util\Collection\{ArrayCollection, CollectionBuilder, StrictTypedCollectionBuilder};
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * @group unit
 * @group collection
 * @coversDefaultClass StrictTypedCollectionBuilder
 */
class StrictTypedCollectionBuilderTest extends TestCase {

    /** @var CollectionBuilder */
    private $builder;
    /** @var ArrayCollection */
    private $collection;

    public function provider(): array {
        return [
            [
                'first' => new DateTimeImmutable('14-01-2014'),
                'second' => new DateTimeImmutable('12-11-2011'),
                'third' => new DateTimeImmutable('17-12-2017')
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
     * @throws TypeError
     * @throws \Exception
     */
    public function it_should_be_able_to_add_elements($fixture): void {

        foreach ($this->collection as $item) {
            $this->builder->add($item);
        }
        /** @var DateCollection $firstCollection */
        $firstCollection = $this->builder->build();

        $this->assertEquals($firstCollection, $this->collection);
        $this->assertEquals(3, $firstCollection->count());

        $newElement = new \DateTimeImmutable('10-12-2017');
        $this->builder->add($newElement);
        /** @var DateCollection $secondCollection */
        $secondCollection = $this->builder->build();

        $this->assertEquals(4, $secondCollection->count());
        $this->assertTrue($secondCollection->contains($newElement));
    }

    /**
     * @covers ::addAll
     * @test
     * @dataProvider provider
     *
     * @param $fixture
     */
    public function it_should_be_able_to_add_all_elements_from_same_type_collection($fixture): void {
        $this->builder->addAll($this->collection);
        $createdCollection = $this->builder->build();

        $this->assertTrue($createdCollection->equals($this->collection));
    }

    /**
     * @covers ::add
     * @test
     */
    public function it_should_throw_exception_when_add_item_of_type_diff_from_declared() {
        $this->expectException(TypeError::class);

        $this->builder->add(new DateTime());
    }

    /**
     * @covers ::addAll
     * @test
     */
    public function it_should_throw_exception_when_add_typed_collection_of_type_diff_from_declared(): void {
        $this->expectException(TypeError::class);
        $collection = DateIntervalCollection::fromArray([new DateInterval('P1D'), new DateInterval('P1Y')]);

        $this->builder->addAll($collection);
    }

    /**
     * @dataProvider provider
     */
    protected function setUp() {
        parent::setUp();
        $fixture = $this->getProvidedData();
        $this->collection = DateCollection::fromArray($fixture);
        $this->builder = new StrictTypedCollectionBuilder(DateCollection::class, $this->collection->getValueType());
    }
}