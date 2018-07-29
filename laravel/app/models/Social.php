<?php

class Social {
	// lietotaja - datu atalse
	public static function GetData($imei_code, $sh1)
	{
		if ($sh1 == sha1($imei_code . "+secureGetDataSocial"))
		{
			// nocekojam vai juseris ir DB
			$rs = DB::table("users")
						->where("imei_code", "=", $imei_code)
						->take(1)
						->get();

			if (empty($rs))
			{
				return 25;
			}

			// savacaam kads ir aktiivais keywords (kamer nav maksas versija un ir pieejams tikai viens AV)
			$ms = DB::table('keywords')
						->select('keyword')
						->where('imei_code', '=', $imei_code)
						->take(1)
						->get();

			$ms = array_shift($ms);

			// atlasam lietotaaja datus
			$rs = DB::table("tweets")
						->select(
							"keywords",
							"screen_name",
							"full_name",
							"date",
							"tweet",
							"url_to_tweet",
							"profile_img",
							"followers",
							"retweets",
							"favorites",
							"source"
						)
						->where("imei_code", "=", $imei_code)
						->where("keywords", "=", mb_strtolower($ms->keyword, 'UTF-8'))
						->orderBy("id", "desc")
						->take(20)
						->get();

			$return_data = array();

			foreach($rs as $item)
			{
				$return_data[] = array(
					"keywords" 		=> $item->keywords,
					"screen_name" 	=> $item->screen_name,
					"full_name" 	=> $item->full_name,
					"date" 			=> $item->date,
					"tweet" 		=> $item->tweet,
					"url_to_tweet" 	=> $item->url_to_tweet,
					"profile_img" 	=> $item->profile_img,
					"followers" 	=> $item->followers,
					"retweets" 		=> $item->retweets,
					"favorites" 	=> $item->favorites,
					"source" 		=> strip_tags($item->source)
				);
			}

			return $return_data;
		}	

		return 21;
	}

	// lietotaja - visi atslegas vardi
	public static function GetUser($imei_code, $sh1) 
	{
		if ($sh1 == sha1($imei_code . "+secureGetUserSocial"))
		{
			// nocekojam vai juseris ir DB
			$rs = DB::table("users")
						->where("imei_code", "=", $imei_code)
						->take(1)
						->get();

			if (empty($rs))
			{
				return 25;
			}

			// atlasam visus atslegas vardus
			$rs = array_shift($rs);

			$rs = DB::table("keywords")
						->where("imei_code", "=", $rs->imei_code)
						->take(100)
						->get();

			$keys = array();

			if (!empty($rs))
			{
				foreach($rs as $item)
				{
					array_push($keys, $item->keyword);
				}
			}

			return $keys;
		}

		return 21;
	}

	// atslegas vaarda dzeeshana
	public static function RemAV($imei_code, $sh1) 
	{
		if ($sh1 == sha1($imei_code . "+secureRemAVSocial"))
		{
			// nocekojam atslegas varada garumu
			$len = mb_strlen(Input::get("keyword"));

			if ($len < 1 || $len > 50) 
			{
				return 22;
			}

			// nocekojam vai lietotajam pieder keywords
			$rs = DB::table("keywords")
						->where("imei_code", $imei_code)
						->where("keyword", Input::get("keyword"))
						->take(1)
						->get();

			if (empty($rs)) 
			{
				return 24;
			}

			// dzesham keywordu
			$rs = array_shift($rs);
			
			DB::table("keywords")
					->where("id", "=", $rs->id)
					->delete();

			return 1;
		}

		return 21;
	}

	// atslegas varda pievienoshana
	public static function AddAV($imei_code, $sh1) 
	{
		if ($sh1 == sha1($imei_code . "+secureAddAVSocial")) 
		{
			// nocekojam atslegas varada garumu
			$len = mb_strlen(Input::get("keyword"));

			if ($len < 1 || $len > 50) 
			{
				return 22;
			}

			// nocekojam vai ieksh DB jau nav tads atslegasvards
			$rs = DB::table("keywords")
						->where("imei_code", "=", $imei_code)
						->where("keyword", "=", Input::get("keyword"))
						->take(1)
						->get();

			if (!empty($rs)) 
			{
				return 23;
			}

			// nocekojam vai nav jau pievienots alsleegas vaards, ja ir, tad error un neljaujam pievienot (pagaidam klients var pievienot tikai vienu AV)
			$rs = DB::table("keywords")
						->where("imei_code", "=", $imei_code)
						->take(1)
						->get();

			if (!empty($rs)) 
			{
				return 35;
			}

			// pievienojam DB atslegas vardu
			DB::table("keywords")->insert(array(
				"imei_code" => $imei_code,
				"keyword" => Input::get("keyword"),
				"created_at" => date("Y-m-d H:i:s")
			));

			return 1;
		}

		return 21;
	}

	// jusera pievienoshana + droshibas chekoshana
	public static function Add($imei_code, $sh1) 
	{
		if ($sh1 == sha1($imei_code . "+secureAddSocial")) 
		{	
			$rs = DB::table("users")
						->where("imei_code", "=", $imei_code)
						->take(1)
						->get();

			if (!empty($rs)) {
				return 36;
			}

			DB::table("users")->insert(array(
				"imei_code" => $imei_code,
				"created_at" => date("Y-m-d H:i:s")
			));
			
			return 1;
		} 

		return 21;	
	}
}