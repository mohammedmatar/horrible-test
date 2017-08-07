<?php
	namespace SampleApp;
	use League\Event\Emitter;
use Illuminate\Database\QueryException;
	class Eventer {
		private $emitter;
		public $heroes = array();
		const EVENT_LOG_TO_FILE = 'log.file';
		const EVENT_LOG_TO_DB = 'log.db';

		public function __construct() {
			$this->emitter = new Emitter;
		}
		public function logToDatabase($heroToLog) {
			$db = DatabaseProvider::getInstance();
        	$db->initConnection();
			// $db->migrateUp(); 
        	$hero = new Hero();
        	$hero->create( array(
            	"name" => $heroToLog->name,
            	"age" => $heroToLog->age,
            	"power" => $heroToLog->power,
            	"avatar" => $heroToLog->avatar
        	));
			$hero->save();
			array_push($this->heroes, $hero->name);
		}
		public function execute($logType, $eventArg = 'noArg') {
			$this->emitter->addListener(static::EVENT_LOG_TO_DB, function($event, $heroToLog){
				$this->logToDatabase($heroToLog);
			});
			$this->emitter->addListener(static::EVENT_LOG_TO_FILE, function($event, $heroToLog){
				$logFile = fopen("newfile.txt", "a") or die("Unable to open file!");
				fwrite($logFile, '[ '.date("Y-m-d h:i").' ] '.$heroToLog->name."\n");
				fclose($logFile);
			});
			if ($eventArg !== 'noArg') {
				$this->emitter->emit($logType, $eventArg);
			} else {
				echo "no data";
			}
		}
	}
