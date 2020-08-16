<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
class CronController extends Controller{
 
	/**
	 * Create a new controller instance.
	 */
	public function __construct(){
		//$this->middleware('guest');
	}


 
	public function dbBackup()
	    {
	       $filename = "backup-" . date('Y-m-d-h-i-s-a') . ".gz";
	        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/backups/" . $filename;
	        $returnVar = NULL;
	        $output  = NULL;
	        exec($command, $output, $returnVar);
	    }

}
