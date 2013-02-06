<?php

putenv('APPLICATION_ENV=test');
putenv('APPLICATION_WING=pl');
require_once __DIR__ . '/../../init.php';

Application::bootstrap();
$config = Zend_Registry::get('config');

$dbConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/database.ini', APPLICATION_ENV);

$descriptorspec = array(
	0 => array("pipe", "r"),
	1 => array("pipe", "w"),
	2 => array("pipe", "w")
);

if (! $dbConfig->parallel_processes) {
	exit("You don't have parallel_processes support setup on 'database.ini'." . PHP_EOL);
}

$rootPass = isset($argv[1]) ? $argv[1] : 'root';

$db = Zend_Registry::get('database');
$dbSource = $dbConfig->params->dbname;
$dbHost = $dbConfig->params->host;
$dbUser = $dbConfig->params->username;
$dbPass = $dbConfig->params->password;
$availableDatabases = $db->fetchAll("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME LIKE '{$dbSource}%'");

for ( $token = 0; $token < $dbConfig->parallel_processes; $token++ ) {
	$dbTarget = $dbSource.($token+1);
	if (!in_array(array('SCHEMA_NAME' => $dbTarget), $availableDatabases)) {
		$command = 'sh ' . APPLICATION_PATH . "/../scripts/db/copy-database.sh $dbSource $dbTarget $dbHost $rootPass $dbUser $dbPass";
        echo "Running command \n$command\n";
		$process = proc_open($command , $descriptorspec, $pipes);
		echo "Database {$dbTarget} started" . PHP_EOL;

		if (is_resource($process)) {
			fclose($pipes[0]);
			echo stream_get_contents($pipes[1]) . PHP_EOL;
			fclose($pipes[1]);

			$returnValue = proc_close($process);
			if ($returnValue !== 0) {
				echo "Value returned $returnValue" . PHP_EOL;
			}
		}
	}

	echo "Migrating data on {$dbTarget}" . PHP_EOL;
	echo exec('APPLICATION_ENV=test TEST_TOKEN=' . $token . ' php ' . APPLICATION_PATH . '/../scripts/db/migrate.php') . PHP_EOL;
}
