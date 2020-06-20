<?php

require __DIR__ . '/vendor/autoload.php';

if (file_exists(__DIR__ . '/vendor/symfony/dotenv/composer.json')) {
	$dotenv = new Symfony\Component\Dotenv\Dotenv(true);
	$dotenv->load(__DIR__ . '/.env');
}

use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;

if (empty(getenv('CONSUMER_KEY')) && empty(getenv('CONSUMER_SECRET'))) {
	exit('Twitter Consumer API config not set. Exiting.');
}

$user = getenv('SCAN_USER_NAME');
$to   = Carbon::today()->format('Y-m-d');
$from = Carbon::today()->subDays(1)->format('Y-m-d');
$com  = "from:{$user} since:{$from} until:{$to}";

$connection = new TwitterOAuth(getenv('CONSUMER_KEY'), getenv('CONSUMER_SECRET'), getenv('ACCESS_TOKEN'), getenv('ACCESS_SECRET'));
$content    = $connection->get('search/tweets', [
	'q'     => $com,
	'count' => 100,
]);

$message  = sprintf(getenv('GENERAL_MESSAGE'), "@{$user}", count($content->statuses));
$tweet_on = ( getenv('GENERAL_TWEET_ENABLED') === '1' ) ? true : false;
$resp     = null;
if ($tweet_on) {
	$resp = $connection->post('statuses/update', ['status' => $message]);
} else {
	echo 'Tweeting is off.' . PHP_EOL;
}

echo 'https://twitter.com/search?q=' . urlencode($com) . PHP_EOL;
echo $message;
exit(0);