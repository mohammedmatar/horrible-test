<?php
/**
 * Created by PhpStorm.
 * User: abdosaeed
 * Date: 02/08/17
 * Time: 11:20 م
 */

namespace SampleApp;

use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseProvider {
    private static $instances = array();
    protected function __construct() { $this->capsule = new Capsule(); }
    protected function __clone() {}
    private $capsule;
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    public static function getInstance()
    {
        $cls = get_called_class(); // late-static-bound class name
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }
        return self::$instances[$cls];
    }

    public function initConnection()
    {
        $this->capsule->addConnection(array(
            'driver'    => 'sqlite',
            //'host'      => 'sql8.freemysqlhosting.net',
            'database'  => 'database.sqlite',
            //'username'  => 'sql8188361',
            //'password'  => 'qC9jzENHlQ',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci'
//            'prefix'    => ''
        ));
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    public function migrateUp()
    {
        Capsule::schema()->create('heroes', function ($table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->string('power')->nullable();
            $table->string('avatar')->nullable();
            $table->string('updated_at');
            $table->string('created_at');
//            $table->nullableTimestamps();
        });
    }
}
