# Tweet count bot
A bot that posts a daily update of how many tweets you did the day before.

## Environmental Variable Inputs
This project accepts the following inputs:

* `CONSUMER_KEY` The application key of your Twitter app.
* `CONSUMER_SECRET` The secret code of your Twitter app.
* `ACCESS_TOKEN` Access token to your posting account (auto OAuth not supported yet).
* `ACCESS_SECRET` Secret token of the posting account.
* `SCAN_USER_NAME` The username to be scanning the post count from.
* `GENERAL_TWEET_ENABLED` Should the scraped tweet count be tweeted out? (Default 1).
* `GENERAL_MESSAGE` A printf-compatible string to format the tweet. (Default is "Yesterday, %s tweeted %d times.").

## Running via Docker
[This propject is on Dockerhub][dockerimg], and can be used as an exec command.

```
docker run \
	--env CONSUMER_KEY=YourKeyGoesHere \
	--env CONSUMER_SECRET=YourKeyGoesHere \
	--env ACCESS_TOKEN=YourKeyGoesHere \
	--env ACCESS_SECRET=YourKeyGoesHere \
	--env SCAN_USER_NAME=thealmightyword \
	soupbowl/tweet-count-bot:latest
```
(for Powershell, replace backslash with backticks(`) if you wish to preserve newlines).

## Running natively
Clone this repository, and run `composer install`. If you have a .env file in the same directory, it will be loaded in. Please see .env.example for usage.

Once installed and setup, simply run `php bot.php` to execute.

---

If either method is executed successfully, you should get a response like this:
```
https://twitter.com/search?q=from%3Athealmightyword+since%3A2020-06-20+until%3A2020-06-21
Yesterday, @thealmightyword tweeted 5 times.
```

[dockerimg]: https://hub.docker.com/repository/docker/soupbowl/tweet-count-bot