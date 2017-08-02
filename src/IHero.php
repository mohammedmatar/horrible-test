<?php
/**
 * Created by PhpStorm.
 * User: Mohammed Matar
 * Date: 02/08/17
 * Time: 11:17 ص
 */

namespace SampleApp;


class IHero
{
    public $name;
    public $age;
    public $power;
    public $avatar;

    public function create($name, $age, $power, $avatar = '')
    {
        $this->name     = $name;
        $this->age      = $age;
        $this->power    = $power;
        $this->avatar   = $avatar;
        return $this;
    }
    public function description()
    {
        return
            <<<EOT
            =============================
            = Hero Name  : $this->name;  =
            = Hero Age   : $this->age;   =
            = Hero Power : $this->power; =
            = Hero Avatar: $this->avatar; =
            ============================= 
EOT;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

}