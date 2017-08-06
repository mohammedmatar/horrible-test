<?php
/**
 * Created by PhpStorm.
 * User: Mohammed Matar
 * Date: 02/08/17
 * Time: 11:58 ص
 */

namespace SimpleApp;

use \SampleApp\HeroAgency;
use PHPUnit\Framework\TestCase;
use \SampleApp\IHero;
use Illuminate\Database\Capsule\Manager as Capsule;
use Faker\Factory;
/**
 * @codeCoverageIgnore
 */
class HeroAgencyTest extends TestCase
{
    /**
     * @test
     * @covers HeroAgency::hire()
     */
    public function hero_is_hired()
    {
        $heroes = new HeroAgency();

        $mrRobot = new IHero();
        $mrRobot->name  = 'Mr Robot';
        $mrRobot->age   = 25;
        $mrRobot->power = 'Hacking';

        $blackGeek = new IHero();
        $blackGeek->name    = 'Black Geek';
        $blackGeek->power   = 'Tracking People';
        $blackGeek->age     = 9;


        $this->assertEmpty( $heroes->allHeroes(), 'There is no heroes available right now !' );
        $heroes->hire( $mrRobot );
        $this->assertEquals( 1, $heroes->numberOfHeroes(), 'Number of Heroes is not increased !');
//        $heroes->hire( $blackGeek );
//        $this->assertEquals( 2, $heroes->numberOfHeroes(), 'Number of Heroes is not increased !');
    }


    /**
     * @test
     * @covers HeroAgency::hire()
     */
    public function hero_is_hired_by_faker()
    {
        $faker = Factory::create();
        $hero = new IHero();
        $heroAgency = new HeroAgency();
        for( $index = 1; $index <= 100; $index++ ) {
            $hero->create(
                $faker->name(),
                $faker->numberBetween(9, 40),
                $faker->realText($maxNbChars = 10),
                $faker->imageUrl( 80, 80, Category::BUSINESS )
            );
            $heroAgency->hire($hero);
        }
        var_dump($heroAgency->allHeroes());
        $this->assertEquals( 10, $heroAgency->numberOfHeroes(), ''. $heroAgency->numberOfHeroes(). 'heroes is hired !');
    }

    /**
     * @test
     * @covers HeroAgency::terminateContract()
     */
    public function terminate_contract_of_a_hero()
    {
        $faker = Factory::create();
        $hero = new IHero();
        $heroAgency = new HeroAgency();
        for( $index = 1; $index <= 10; $index++ ) {
            $hero->create(
                $faker->name(),
                $faker->numberBetween(9, 40),
                $faker->realText($maxNbChars = 10),
                $faker->imageUrl( 80, 80, Category::BUSINESS )
            );
            $heroAgency->hire($hero);
        }
        $heroAgency->terminateContract(($heroAgency->allHeroes()[4])->name);
        $this->assertEquals( 9, $heroAgency->numberOfHeroes(), 'Number of Heroes is not decreased !');
    }

}

class Category {
    const PEOPLE        = 'people';
    const ANIMAL        = 'animal';
    const TRANSPORT     = 'transport';
    const TECHNICS      = 'technics';
    const SPORTS        = 'sports';
    const NATURE        = 'nature';
    const FASHION       = 'fashion';
    const NIGHTLIFE     = 'nightlife';
    const CATS          = 'cats';
    const CITY          = 'city';
    const BUSINESS      = 'business';
    const ABSTRACT      = 'abstract';
}
