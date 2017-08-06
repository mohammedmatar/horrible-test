<?php
/**
 * Created by PhpStorm.
 * User: abdosaeed
 * Date: 02/08/17
 * Time: 11:11 م
 */

namespace SampleApp;
use Illuminate\Database\Eloquent\Model;

class HeroAgencyController
{
    private $heroes = [];
    public function getAll($req, $res)
    {
        $db = DatabaseProvider::getInstance();
        $db->initConnection();
//        $db->migrateUp();
        $res->setFormat("json");
        $res->add( Hero::all());
        $res->send(200);
    }

    public function hire( $req, $res )
    {
        $db = DatabaseProvider::getInstance();
        $db->initConnection();

        $req->format = 'json';

        $reqData = json_decode(json_encode(json_decode($req->data["_RAW_HTTP_DATA"])[0]), true);
        var_dump($reqData);
        $hero = new Hero();

        $hero->create( array(
            "name" => $reqData["name"],
            "age" => $reqData["age"],
            "power" => $reqData["power"],
            "avatar" => $reqData["avatar"]
        ));
        $hero->save();

        $db->migrateUp();
        $res->setFormat('text');
        $res->add( $hero );
        $res->send(200);
    }
}
class Hero extends Model {
    protected $table = 'heroes';
    protected $fillable = array( "name", "age", "power", "avatar" );
}