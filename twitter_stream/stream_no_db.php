<?php

require_once('phirehouse/Phirehose.php');
require_once('phirehouse/OauthPhirehose.php');
require_once('ansi-color.php');

use PhpAnsiColor\Color;

// twitter oAuth atslegas
define('TWITTER_CONSUMER_KEY', 'cAyVhalss6xqrGwPPtogBudj9');
define('TWITTER_CONSUMER_SECRET', '1j317Rnrmw0a1RyaZJlYdLuWOvrdCG8weBJuU6hELE3Tnmmh4P');
define('OAUTH_TOKEN', '2523393146-oQc41MrqtmfWVjGH8GeeE8P0e8jVIFCmVsK9YaG');
define('OAUTH_SECRET', 'mNmU8jZSxT3RHIneCw9vc1brJluVsB2l79BPZS34hwp7D');

// Twitter Api klase
class FilterTrackConsumer extends OauthPhirehose
{
	public $how_many_found 		= 0;
	public $all_keys 			= array();
	public $all_keys_and_imei 	= array();

	// funkcijas kas tiek izsaukta kad nokkerts twiits
	public function enqueueStatus($status)
	{
		$data = json_decode($status, true);
		if (is_array($data) && isset($data['user']['screen_name'])) {
			$screen_name 	= $data['user']['screen_name'];
			$full_name 		= $data['user']['name'];
			$date 			= date('Y-m-d H:i:s');
			$tweet 			= $data['text'];
			$url_to_tweet 	= 'https://twitter.com/' . $screen_name . '/status/' . $data['id_str'];
			$profile_img 	= $data['user']['profile_image_url'];
			$tweet_id 		= $data['id'];
			$followers		= $data['user']['followers_count'];
			$retweets		= $data['retweet_count'];
			$favorites		= $data['favorite_count'];
			$source			= $data['source'];
			$user_id		= $data['user']['id_str'];

			$this->how_many_found++;

			if (!empty($data['retweeted_status'])) 
			{
				$retweets 	= $data['retweeted_status']['retweet_count'];
				$favorites 	= $data['retweeted_status']['favorite_count'];
				$tweet_id 	= $data['retweeted_status']['id'];	
			} 
			
			$tweet 	= str_replace("\n", '', $tweet);
			$out 	= $this->how_many_found . ") {$screen_name} ({$full_name}): {$tweet}\n";
			echo Color::set($out, ( !empty($data['retweeted_status']) ? 'yellow' : 'green' ) );
		}
	}
}

// Saakam strriimingu
$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
$sc->setTrack(array("un", "bet"));
$sc->setLang("lv");
$sc->consume();

























