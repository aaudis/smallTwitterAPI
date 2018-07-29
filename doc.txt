http://mapi.leta.lv/social/getdata/356938035643809/4a3d5162f85d572840fea5573f1133df052e57cf/


padomaa par return VALUE
par error codiem 

!! atslēgas vārda garums 1 - 50
!! ko daram ar followeriem, retwiitiem?
!! cik daudz AV var vispar pievienot, maksajosh, nemaksajoshs?

!! security checks, pirmos 20 tviitus padodam, japieliek lauks, kas cheko vai ir padoti 20 twiiti
!! ir maksas juseris jeb nav



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







Viņi taisa
	- Lietotāju autorizācija/reģistrācija
	- Keywordu uzturēšana (labošana, pievienošana, utt)
	- Maksājumi
	- Web puse
	- Visi limiti kas saistīti ar Keywordiem, maksājumiem
	- Pielāgošana pie mūsu API

<!-- LETAs darbi (nodrošināt API)
AJ: vajag paredzēt arī API nodokumentēšanu, ne tikai pašu API, lai mums nav viņiem jāstāv blakus un jābaksta ar pirkstu, kur kas jāliek.
 - Lietotāju pievienošana/dzēšana, requests mums: ADD user, REM user ~ 
(2-3 dienas)
AJ: aktuāls jautājums ir, vai mēs negribam pie sevis tos lietotājus arī pēc tam pieglabāt savā DB, iespējams viņus nevajadzētu dzēst tādēļ -->
 
<!-- - Pie Keyworda pievienošanas/dzēšanas, requests mums: KEY pievienošana, 
KEY dzēšana ~ (2-3 dienas)
	- Crawlera pielāgošana, pie sistēmas (Twitter, Interneta portāli, par 
citiem nemaz nedomāju šobrīd, priekš sākuma būs ok) ~ (1 nedēļa)
AJ: Facebook publiskās lapas arī jāņem iekšā, par to ir runa bijusi visu laiku -->

 - Requests pēc lietotāja ID, datu atdošana (JSON, HTML) ~ (1 nedēļa)
AJ: šim pirmo daļu īsti nesapratu - par kāda lietotāja ID mēs runājam?

 - Amortizācija ~ (1 nedēļā)
AJ: Amortizācija=buferis?

salīdzini, vai neesmu kaut ko aizmirsis
AJ: pirmajā iterācijā, domāju, ka ir gana ok detalizācija. Tālāk domāsim precīzāk, ja būs nākamie soļi.











