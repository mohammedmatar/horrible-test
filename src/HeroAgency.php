<?php
/**
 * Created by PhpStorm.
 * User: Mohammed Matar
 * Date: 02/08/17
 * Time: 10:59 ص
 */

namespace SampleApp;
/**
 * Class HeroAgency
 * @package SampleApp
 */
class HeroAgency extends Collection
{
    /**
     * HeroAgency constructor.
     */
    public function __construct()
    { parent::__construct(); }
    /**
     * @param $hero
     * @return array
     */
    public function hire( $hero )
    {
        $this->add( $hero );
        return $this->objects;
    }
    /**
     * @param $heroName
     * @return array
     */
    public function terminateContract( $heroName )
    {
        $this->removeByProperty( 'name', $heroName );
        return $this->objects;
    }

    /**
     *
     */
    public function terminateAllContracts()
    {
        $this->removeAll();
    }
    /**
     * @param $hero
     * @param string $property
     * @return bool|mixed
     */
    public function find($hero, $property = 'name' )
    {
        return $this->findByProperty( $property, $hero);
    }

    /**
     * @param $property
     * @param string $sortType
     * @return array
     */
    public function sort($property, $sortType = 'r' )
    {
        $this->sortByProperty( $property, $sortType );
        return $this->objects;
    }

    /**
     * @return int
     */
    public function numberOfHeroes()
    {
        return $this->numObjects;
    }

    /**
     * @return array
     */
    public function allHeroes()
    {
        /*$mrRobot = new IHero();
        $mrRobot->name  = 'Mr Robot';
        $mrRobot->age   = 25;
        $mrRobot->power = 'Hacking';

        $blackGeek = new IHero();
        $blackGeek->name    = 'Black Geek';
        $blackGeek->power   = 'Tracking People';
        $blackGeek->age     = 9;

        $this->hire( $mrRobot );
        $this->hire( $blackGeek );
		return json_encode($this->objects);
		*/
		return $this->objects;

    }
}
