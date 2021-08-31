<?php

namespace Granule\Tests\Util\Collection;

use Granule\Util\Collection\ArrayCollection;
use Granule\Util\Collection\CollectionBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @group collection
 * @coversDefaultClass CollectionBuilder
 */
class CollectionBuilderTest extends TestCase
{
    public function provider(): array
    {
        return [
            [
                [
                    'first' => new \DateTime('14-01-2014'),
                    'second' => new \DateTime('12-11-2011'),
                    'third' => new \DateTime('17-12-2017')
                ],
                ArrayCollection::class
            ]
        ];
    }

    /**
     * @covers ::add
     * @test
     * @dataProvider provider
     *
     * @param array  $fixture
     * @param string|ArrayCollection $class
     *
     */
    public function it_should_be_able_to_add_elements(array $fixture, string $class): void
    {
        $builder = $class::builder();
        foreach ($fixture as $item) {
            $builder->add($item);
        }
        /** @var ArrayCollection $firstCollection */
        $firstCollection = $builder->build();
        $this->assertEquals(3, $firstCollection->count());

        $newElement = new \DateTime('10-12-2017');
        $builder->add($newElement);
        /** @var ArrayCollection $secondCollection */
        $secondCollection = $builder->build();
        $this->assertEquals(4, $secondCollection->count());
        $this->assertTrue($secondCollection->contains($newElement));
    }

    /**
     * @covers ::add
     * @test
     * @dataProvider provider
     *
     * @param array  $fixture
     * @param string|ArrayCollection $class
     * @paran $class
     *
     */
    public function it_should_be_able_to_add_diff_type_elements(array $fixture, string $class): void
    {
        $sourceCollection = $class::fromArray($fixture);
        $builder = $class::builder();

        foreach ($sourceCollection as $item) {
            $builder->add($item);
        }
        $builder->add(new \DateInterval('P1M'));

        /** @var ArrayCollection $createdCollection */
        $createdCollection = $builder->build();
        $firstElement = $createdCollection->get(0);
        $lastElement = $createdCollection->get($createdCollection->count() - 1);

        $this->assertEquals($createdCollection->count(), $sourceCollection->count() + 1);
        $this->assertNotEquals(get_class($firstElement), get_class($lastElement));
    }

    /**
     * @covers ::addAll
     * @test
     * @dataProvider provider
     *
     * @param array  $fixture
     * @param string|ArrayCollection $class
     *
     */
    public function it_should_be_able_to_add_collection_of_elements(array $fixture, string $class): void
    {
        $builder = $class::builder();

        $newElements = ArrayCollection::fromArray([
            new \DateTimeImmutable('10-12-2017'),
            new \DateTimeImmutable('11-12-2017')
        ]);

        $builder->addAll($newElements);
        /** @var ArrayCollection $createdCollection */
        $createdCollection = $builder->build();

        $this->assertEquals(2, $createdCollection->count());
        $this->assertTrue($createdCollection->contains($newElements[0]));
        $this->assertTrue($createdCollection->contains($newElements[1]));
    }
}
