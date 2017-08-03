<?php // arrayobject.spec.php

use \SampleApp\HeroAgency;
use \SampleApp\IHero;
use Faker\Factory;

describe('ArrayObject', function() {

    beforeEach(function() {
        $this->heroes = new HeroAgency();

        $mrRobot = new IHero();
        $mrRobot->name  = 'Mr Robot';
        $mrRobot->age   = 25;
        $mrRobot->power = 'Hacking';

        $blackGeek = new IHero();
        $blackGeek->name    = 'Black Geek';
        $blackGeek->power   = 'Tracking People';
        $blackGeek->age     = 9;

        $this->heroes->hire( $mrRobot );
        $this->heroes->hire( $blackGeek );

		$this->arrayObject = new ArrayObject(['one', 'two', 'three']);
		$this->name = 'SNSO';
    });

    describe('#HeroesAgency Class', function() {
        it('should return count of heroes', function() {
            $count = $this->heroes->numberOfHeroes();
            assert($count === 2, 'expected 3');
        });
    });
});
