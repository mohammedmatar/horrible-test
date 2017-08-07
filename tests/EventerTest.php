<?php
namespace SimpleApp;

use \SampleApp\HeroAgency;
use PHPUnit\Framework\TestCase;
use \SampleApp\IHero;
use Illuminate\Database\Capsule\Manager as Capsule;
use Faker\Factory;
use \SampleApp\Eventer;
/**
 * @codeCoverageIgnore
 */
class EventerTest extends TestCase {
    /**
     * @test
     */
    public function log_hero_to_database() {
        $eventer = new Eventer;

        $hero = new IHero();
        $hero->name     = 'mr. Crazy DOG';
        $hero->age      = 42;
        $hero->power    = 'Can Understand Dogs language';
        $hero->avatar   = 'http://cdn2us.denofgeek.com/sites/denofgeekus/files/2016/01/mr-robot-usa-rami-malek.jpg';

        $eventer->execute(Eventer::EVENT_LOG_TO_DB, $hero);
        $this->assertCount(1, $eventer->heroes);
    }
    /**
     * @test
     */
    public function log_hero_to_file(){
        $eventer = new Eventer;
        $faker = Factory::create();
        $hero = new IHero();
        $heroAgency = new HeroAgency();
        $hero->create(
            $faker->name(),
            $faker->numberBetween(9, 40),
            $faker->realText($maxNbChars = 10),
            $faker->imageUrl( 80, 80, Category::BUSINESS )
        );
        $heroAgency->hire($hero);
        $eventer->execute( Eventer::EVENT_LOG_TO_FILE, $hero);
        $this->assertFileExists('newfile.txt');
        // echo file_get_contents("newfile.txt");
        $fcontents = file_get_contents("newfile.txt");
        $this->assertContains($hero->name, json_encode($fcontents, true), "#TEST Hero is not logged to file");
    }
}
