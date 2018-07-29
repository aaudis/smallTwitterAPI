Lietotaja pievienošana 
======================

	GET - http://mapi.leta.lv/social/add/<IMEI_CODE>/<SHA1_DEF>/

	IMEI_CODE
		- Lietotāja telefona IMEI kods, paraugs: 356938035643809

	SHA1_DEF
		- hash SH1 vērtība, satāv no: 356938035643809+secureAddSocial => e64a3629cd3481591d9f2fe748b58a64741c9093

	Atgriež - JSON formāts:

		Ja viss ir ok:

			[
				{
					"message": "ok"
				}
			]

		Notika kļūda (IMEI kods nepareizs, SH1 nepareizs):

			[
				{
					"error": "Something happened!",
					"status": 21
				}
			]


Pievienot/Dzēst atslēgas vārdu
==============================

	Pievienot atslēgas vārdu
	------------------------

		POST - http://mapi.leta.lv/social/addav/<IMEI_CODE>/<SHA1_DEF>/
			parametri:
				"keyword" => "LETA"   // LETA vietā liekam lietotāja izvēlēto atslēgas vārdu kas jāpievieno

		IMEI_CODE
			- Lietotāja telefona IMEI kods, paraugs: 356938035643809

		SH1_DEF
			- hash SH1 vērtība, satāv no: 356938035643809+secureAddAVSocial => d622297188004ba2a3f7fa3a91b9751a317c4ad3

		Atgriež - JSON formāts:

			Ja viss ir ok:

				[
					{
						"message": "ok"
					}
				]

			Notika kļūda (IMEI kods nepareizs, SH1 nepareizs, vārda garums par īsu/garu, utt):

				[
					{
						"error": "Something happened!",
						"status": 21
					}
				]

					Statusi:
						21 - SHA1 nesakrīt
						22 - Atslēgas vārda garums ir arpus robežas 1-50
						23 - Tāds atslēgas vārds jau ir pievienots DB
						35 - Atslēgas vārds jau pievienots (šobrīd limits 1 atslēgas vārds lietotājam)

	Dzēst atslēgas vārdu
	--------------------
		
		POST - http://mapi.leta.lv/social/remav/<IMEI_CODE>/<SHA1_DEF>/
			parametri:
				"keyword" => "LETA"   // LETA vietā liekam lietotāja izvēlēto atslēgas vārdu ko dzēst

		IMEI_CODE
			- Lietotāja telefona IMEI kods, paraugs: 356938035643809

		SH1_DEF
			- hash SH1 vērtība, satāv no: 356938035643809+secureRemAVSocial => 3840639ccb0fdef9df29d24c3ded52daebf1f061

		Atgriež - JSON formāts:

			Ja viss ir ok:

				[
					{
						"message": "ok"
					}
				]

			Notika kļūda (IMEI kods nepareizs, SH1 nepareizs, utt):

				[
					{
						"error": "Something happened!",
						"status": 21
					}
				]

					Statusi:
						21 - SHA1 nesakrīt
						22 - Atslēgas vārda garums ir arpus robežas 1-50
						24 - Atslēgas vārds nav DB


Lietotāja atslēgas vārdu saņemšana
==================================

		GET - http://mapi.leta.lv/social/getuser/<IMEI_CODE>/<SHA1_DEF>/

		IMEI_CODE
			- Lietotāja telefona IMEI kods, paraugs: 356938035643809

		SH1_DEF
			- hash SH1 vērtība, satāv no: 356938035643809+secureGetUserSocial => 48abb58ae9be4e37f62b8618e3349ebdc1a25b5b

		Atgriež - JSON formāts:

			Ja viss ir ok:

				[
					{
						"keys": [
							"LETA",
							"Latvenergo",
							"Airbaltic"
						]
					}
				]

			Notika kļūda (IMEI kods nepareizs, lietoājs neeksistē utt):

				[
					{
						"error": "Something happened!",
						"status": 21
					}
				]

					Statusi:
						21 - SHA1 nesakrīt
						25 - Lietotājs nav atrasts


Datu saņemšana
==============
	
	GET - http://mapi.leta.lv/social/getdata/<IMEI_CODE>/<SHA1_DEF>/

	IMEI_CODE
		- Lietotāja telefona IMEI kods, paraugs: 356938035643809

	SH1_DEF
		- hash SH1 vērtība, satāv no: 356938035643809+secureGetDataSocial => 4a3d5162f85d572840fea5573f1133df052e57cf
		
	Atgriež - JSON formāts:

		Ja viss ir ok:

			[
				{
					"screen_name": 	"LETA_live",
					"full_name": 	"LETA live",
					"date": 		"2014-01-02 15:04:03",
					"tweet": 		"Gulbis tomēr sīvā cīņā cieš neveiksmi ar rezultātu 3-6, 3-6, 6-3, 3-6.",
					"url_to_tweet": "https://twitter.com/LETA_live/status/474910160369250304",
					"profile_img": 	"https://pbs.twimg.com/profile_images/466129027653042176/hoer6XVJ_400x400.jpeg"
				},
				{
					"screen_name": 	"LETA_live",
					"full_name": 	"LETA live",
					"date": 		"2014-01-02 16:04:03",
					"tweet": 		"Šobrīd laukumā dominē servētāji. Rezultāts 4-3 Džokoviča labā.",
					"url_to_tweet": "https://twitter.com/LETA_live/status/474908403689873408",
					"profile_img": 	"https://pbs.twimg.com/profile_images/466129027653042176/hoer6XVJ_400x400.jpeg"
				}
			]

		Notika kļūda (IMEI kods nepareizs, lietotājs neeksistē utt):

			[
				{
					"error": "Something happened!",
					"status": 21
				}
			]

					Statusi:
						21 - SHA1 nesakrīt
						25 - lietotājs neeksistē



DB struktūras
=============

	DB - users
	----------
	id - incremental
	imei_code - bigint (index)
	cerated_at - datetime
	paying - tinyInteger


	DB - keywords
	-------------
	id - incremental
	imei_code - bigint (index)
	keyword - string
	created_at - datetime
	limit_av - integer


	DB - tweets
	-----------
	id - incremental
	imei_code - bigint (index)
	keywords - string
	screen_name - string
	full_name - string
	date - datetime
	tweet - string
	url_to_tweet - string
	profile_img - string

	user_id - bigInteger
	tweet_id - bigInteger
	followers - Integer
	retweets - Integer
	favorites - Integer
	source - string
