<?php

require __DIR__ . '/vendor/autoload.php';

if (file_exists(__DIR__ . '/vendor/symfony/dotenv/composer.json')) {
	$dotenv = new Symfony\Component\Dotenv\Dotenv(true);
	$dotenv->load(__DIR__ . '/.env');
}

use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;

if (empty(getenv('CONSUMER_KEY')) && empty(getenv('CONSUMER_SECRET'))) {
	echo 'Twitter Consumer API config not set. Exiting.';
	die();
}

$connection = new TwitterOAuth(getenv('CONSUMER_KEY'), getenv('CONSUMER_SECRET'), getenv('ACCESS_TOKEN'), getenv('ACCESS_SECRET'));
$content = $connection->get('search/tweets', [
	'from'  => getenv('SCAN_USER_NAME'),
	'since' => Carbon::today()->subDays(2)->format('Y-m-d'),
	'until' => Carbon::today()->subDays(1)->format('Y-m-d'),
	'count' => 100,
]);

var_dump(count($content->statuses));
die();