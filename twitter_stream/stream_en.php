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

// savacam DB konfigu no Laravela
$m = include('../laravel/app/config/database.php');
$m = $m['connections'][$m['default']];

// koneksts ar DB
$db = pg_connect("host=".$m['host']." dbname=".$m['database']." user=".$m['username']." password=".$m['password']) or die("not connected");

// Twitter Api klase
class FilterTrackConsumer extends OauthPhirehose
{
	public $how_many_found 		= 0;
	public $all_keys 			= array();
	public $all_keys_and_imei 	= array();
	public $db;

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

			// chekojam kuram juserim ir piederigs AV un pieskiram to ieksh DB, ja retwiits, updeitojam sekotaju, retvitu, favoritu skaitu
			if (empty($data['retweeted_status']))
			{
				$all_users = array();

				foreach ($this->all_keys_and_imei as $a_key => $a_val) 
				{
					echo Color::set("IMEI: {$a_val['imei']} AV: {$a_val['keyword']}", "red");

					$tweet_transform = str_replace(array("\r", "\t", "#"), '', $tweet);
					$tweet_transform = mb_strtolower($tweet_transform, 'UTF-8');
					$tweet_transform = ' '.$tweet_transform.' ';

					if (mb_strpos($tweet_transform, ' ' . $a_val['keyword'], 0, "UTF-8") !== false || mb_strpos($tweet_transform, $a_val['keyword'] . ' ', 0, "UTF-8") !== false)
					{
						echo Color::set(" - IR", "blue");
						
						// chekojam vai jau shis tviits nav pievienits lietotajam
						if (!empty($all_users[$a_val['imei']])) { echo "\n"; continue; }
						$all_users[$a_val['imei']] = true;

						// insertojam twiitu ieksh DB
						$sql = '
							INSERT INTO
								tweets (
									"imei_code",
									"keywords",
									"screen_name",
									"full_name",
									"date",
									"tweet",
									"url_to_tweet",
									"profile_img",
									"user_id",
									"tweet_id",
									"followers",
									"retweets",
									"favorites",
									"source"
								) VALUES (
									'.(int)$a_val['imei'].',
									\''.$a_val['keyword'].'\',
									\''.pg_escape_string($screen_name).'\',
									\''.pg_escape_string($full_name).'\',
									\''.$date.'\',
									\''.pg_escape_string($tweet).'\',
									\''.pg_escape_string($url_to_tweet).'\',
									\''.pg_escape_string($profile_img).'\',
									'.(int)$data['user']['id'].',
									'.(int)$tweet_id.',
									'.(int)$followers.',
									'.(int)$retweets.',
									'.(int)$favorites.',
									\''.pg_escape_string($source).'\'
								);
						';

						pg_query($this->db, $sql);
					}

					echo "\n";
				}
			} 
			else 
			{
				// nocekojam vai twiits ir sistemaa
				$crs = pg_query($this->db,'
					SELECT
						id
					FROM
						tweets
					WHERE
						tweet_id = '.(int)$tweet_id.'
					LIMIT
						1;
				');

				if ($cr = pg_fetch_object($crs))
				{
					// updeitojam retwiitus un favoritus twiitam
					pg_query($this->db,'
						UPDATE
							tweets
						SET
							retweets 	= '.(int)$retweets.',
							favorites 	= '.(int)$favorites.'
						WHERE
							tweet_id = '.(int)$tweet_id.'; 
					');

					// updeitojam jusera sekotaajus, updeits notiek visiem twiitie, ko lietotajs twitojis
					pg_query($this->db,'
						UPDATE
							tweets
						SET
							followers = '.(int)$followers.'
						WHERE
							user_id = '.(int)$data['retweeted_status']['user']['id'].';
					');
				}
			}

			// info ouputs
			$out 	= $this->how_many_found . ") {$screen_name} ({$full_name}): {$tweet}\n";
			echo Color::set($out, ( !empty($data['retweeted_status']) ? 'yellow' : 'green' ) );
		}
	}

	// funkcija kas ik pa laikam refresho atslegas vardu listi
	public function checkFilterPredicates()
	{
		$rs = pg_query($this->db, '
			SELECT
				imei_code,
				trim(both \' \' from keyword) as av
			FROM
				keywords;	
		');

		// masivs prieks atslegas vardiem un prieks atslegas vardiem ar imei kodiem (lietotajiem)
		$keys = array();
		$keys_imei = array();

		while($r = pg_fetch_object($rs)) 
		{
			// checks vai jau nav masiva atslegas vards
			if (in_array($r->av, $keys) == false) 
			{
				array_push($keys, mb_strtolower($r->av, "UTF-8"));
			}

			// atslegas vards + imei kods
			array_push($keys_imei, array(
				"imei" => $r->imei_code,
				"keyword" => mb_strtolower($r->av, "UTF-8")
			));
		}

		if ($keys !== $this->all_keys || $keys_imei !== $this->all_keys_and_imei) 
		{
			$this->setTrack($keys);
			$this->all_keys = $keys;
			$this->all_keys_and_imei = $keys_imei;
		}
	}
}

// Saakam strriimingu
$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
$sc->db = $db;
$sc->setTrack(array("iphone"));
$sc->setLang("en");
$sc->consume();

pg_close($db);
