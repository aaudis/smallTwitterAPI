<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<style>
			h3 { text-decoration: underline;}
			h4 { font-style: italic; text-decoration: underline; }
			.tab1 { padding-left: 40px; margin-bottom: 80px; }
			.tab2 { padding-left: 80px; }
			.tab3 { padding-left: 120px; }
			.tab4 { padding-left: 160px; }
			.key_1 { color: #203EA1; font-weight: bold; }
			.key_2 { color: #50AB26; font-weight: bold; }
			.key_3 { color: #00C4AD; font-weight: bold; }
			.json { color: #8C7718; }
			.key { color: #CC2528; font-weight: bold; }
			.hash { color: #0021B3; font-weight: bold; }
			.comment { color: #8F8F8F; font-style: italic; }
		</style>
	</head>
	<body>
		<h3>Lietotaja pievienošana</h3>

		<div class="tab1">
			<span class="key">Metode GET</span> - http://mapi.leta.lv/social/add/<span class="key_1">(IMEI_CODE)</span>/<span class="key_2">(SHA1_DEF)</span>/<br><br>

			<span class="key_1">IMEI_CODE</span><br>
				- Lietotāja telefona IMEI kods, paraugs: <span class="key">356938035643809</span><br><br>

			<span class="key_2">SHA1_DEF</span><br>
				- hash SHA1 vērtība, satāv no: <span class="key">356938035643809+secureAddSocial</span> <span class="key_1">=></span> <span class="hash">e64a3629cd3481591d9f2fe748b58a64741c9093</span><br><br>

			Atgriež - JSON formāts:<br><br>

			Ja viss ir ok:<br>

			<pre class="json">
	[
		{
			"message": "ok"
		}
	]
			</pre>

			Notika kļūda (IMEI kods nepareizs, SHA1 nepareizs):

			<pre class="json">
	[
		{
			"error": "Something happened!",
			"status": 21
		}
	]
			</pre>

			Statusi:
					<div class="tab2">
						<span class="key">21</span> - SHA1 nesakrīt, IMEI nepareizs<br>
						<span class="key">36</span> - lietotājs jau eksistē
					</div>
		</div>

		
		<h3>Pievienot/Dzēst atslēgas vārdu</h3>

		<div class="tab1">

			<h4>Pievienot atslēgas vārdu</h4>

				<div class="tab2">

				<span class="key">Metode POST</span> - http://mapi.leta.lv/social/addav/<span class="key_1">(IMEI_CODE)</span>/<span class="key_2">(SHA1_DEF)</span>/<br>
				parametri:<br>
						<div class="tab2"><span class="key">POST</span> <span class="key_3">"keyword" => "LETA"</span></div>
						<div class="tab4"><span class="comment"># LETA vietā liekam lietotāja izvēlēto atslēgas vārdu kas jāpievieno</span></div><br>

				<span class="key_1">IMEI_CODE</span><br>
					- Lietotāja telefona IMEI kods, paraugs: <span class="key">356938035643809</span><br><br>

				<span class="key_2">SHA1_DEF</span><br>
					- hash SHA1 vērtība, satāv no: <span class="key">356938035643809+secureAddAVSocial</span> <span class="key_1">=></span> <span class="hash">d622297188004ba2a3f7fa3a91b9751a317c4ad3</span><br><br>

				Atgriež - JSON formāts:<br><br>

					Ja viss ir ok:<br>
						
						<pre class="json">
	[
		{
			"message": "ok"
		}
	]
						</pre>

					Notika kļūda (IMEI kods nepareizs, SHA1 nepareizs, vārda garums par īsu/garu, utt):

						<pre class="json">
	[
		{
			"error": "Something happened!",
			"status": 21
		}
	]
						</pre>

							Statusi:
								<div class="tab3">
									<span class="key">21</span> - SHA1 nesakrīt, IMEI nepareizs<br>
									<span class="key">22</span> - Atslēgas vārda garums ir arpus robežas 1-50<br>
									<span class="key">23</span> - Tāds atslēgas vārds jau ir pievienots DB<br>
									<span class="key">35</span> - Atslēgas vārds jau pievienots (šobrīd limits 1 atslēgas vārds lietotājam)
								</div>
				</div>

			<h4>Dzēst atslēgas vārdu</h4>

				<div class="tab2">
			
					<span class="key">Metode POST</span> - http://mapi.leta.lv/social/remav/<span class="key_1">(IMEI_CODE)</span>/<span class="key_2">(SHA1_DEF)</span>/<br>
					parametri:<br>
						<div class="tab2"><span class="key">POST</span> <span class="key_3">"keyword" => "LETA"</span></div>
						<div class="tab4"><span class="comment"># LETA vietā liekam lietotāja izvēlēto atslēgas vārdu ko dzēst</span></div><br>

					<span class="key_1">IMEI_CODE</span><br>
						- Lietotāja telefona IMEI kods, paraugs: <span class="key">356938035643809</span><br><br>

					<span class="key_2">SHA1_DEF</span><br>
						- hash SHA1 vērtība, satāv no: <span class="key">356938035643809+secureRemAVSocial</span> <span class="key_1">=></span> <span class="hash">3840639ccb0fdef9df29d24c3ded52daebf1f061</span><br><br>

					Atgriež - JSON formāts:<br>

						Ja viss ir ok:
							
						<pre class="json">	
	[
		{
			"message": "ok"
		}
	]
						</pre>

						Notika kļūda (IMEI kods nepareizs, SHA1 nepareizs, utt):

						<pre class="json">
	[
		{
			"error": "Something happened!",
			"status": 21
		}
	]
						</pre>

								Statusi:
									<div class="tab3">
										<span class="key">21</span> - SHA1 nesakrīt, IMEI nepareizs<br>
										<span class="key">22</span> - Atslēgas vārda garums ir arpus robežas 1-50<br>
										<span class="key">24</span> - Atslēgas vārds nav DB
									</div>
				</div>

		</div>


		<h3>Lietotāja atslēgas vārdu saņemšana</h3>

			<div class="tab1">

				<span class="key">Metode GET</span> - http://mapi.leta.lv/social/getuser/<span class="key_1">(IMEI_CODE)</span>/<span class="key_2">(SHA1_DEF)</span>/<br><br>

				<span class="key_1">IMEI_CODE</span><br>
					- Lietotāja telefona IMEI kods, paraugs: <span class="key">356938035643809</span><br><br>

				<span class="key_2">SHA1_DEF</span><br>
					- hash SHA1 vērtība, satāv no: <span class="key">356938035643809+secureGetUserSocial</span> <span class="key_1">=></span> <span class="hash">48abb58ae9be4e37f62b8618e3349ebdc1a25b5b</span><br><br>

				Atgriež - JSON formāts:<br><br>

					Ja viss ir ok:
					<pre class="json">
[
	{
		"keys": [
			"LETA",
			"Latvenergo",
			"Airbaltic"
		]
	}
]
					</pre>

					Notika kļūda (IMEI kods nepareizs, lietoājs neeksistē utt):

					<pre class="json">
[
	{
		"error": "Something happened!",
		"status": 21
	}
]
					</pre>

							Statusi:
								<div class="tab3">
									<span class="key">21</span> - SHA1 nesakrīt, IMEI nepareizs<br>
									<span class="key">25</span> - Lietotājs nav atrasts
								</div>
			</div>


		<h3>Datu saņemšana</h3>
			
			<div class="tab1">
				<span class="key">Metode GET</span> - http://mapi.leta.lv/social/getdata/<span class="key_1">(IMEI_CODE)</span>/<span class="key_2">(SHA1_DEF)</span>/<br><br>

				<span class="key_1">IMEI_CODE</span><br>
					- Lietotāja telefona IMEI kods, paraugs: <span class="key">356938035643809</span><br><br>

				<span class="key_2">SHA1_DEF</span><br>
					- hash SHA1 vērtība, satāv no: <span class="key">356938035643809+secureGetDataSocial</span> <span class="key_1">=></span> <span class="hash">4a3d5162f85d572840fea5573f1133df052e57cf</span><br><br>
					
				Atgriež - JSON formāts:<br><br>

					Ja viss ir ok:

					<pre class="json">
	[
		{
			keywords: 	"vēl",
			screen_name: 	"osiicc",
			full_name: 	"Oskars",
			date: 		"2014-06-10 11:29:56",
			tweet: 		"Labrītiņ. Tik labi izgulējos un šodien vēl brīvdiena, vismaz skolā (: #kurirbrokastis",
			url_to_tweet: 	"https://twitter.com/osiicc/status/476280087139336192",
			profile_img: 	"http://pbs.twimg.com/profile_images/378800000324117986/aad1a0c95d53ea7699a73f3c6cba1647_normal.jpeg",
			followers: 	172,
			retweets: 	0,
			favorites: 	0,
			source: 	"Twitter for Android"
		},
		{
			keywords: 	"vēl",
			screen_name: 	"_Valcha_",
			full_name: 	"Toms Valters",
			date: 		"2014-06-10 11:29:35",
			tweet: 		"Jau pēc dažām minūtēm uzzināsim @Positivus ielūgumu laimētāju! http://t.co/wcuUvDCnJg Pasteidzies, arī Tu vēl vari pagūt piedalīties!",
			url_to_tweet: 	"https://twitter.com/_Valcha_/status/476279997775089664",
			profile_img: 	"http://pbs.twimg.com/profile_images/455379030233985024/7t-ulxQq_normal.jpeg",
			followers: 	164,
			retweets: 	0,
			favorites: 	0,
			source: 	"Twitter for Websites"
		}
	]
					</pre>

					Notika kļūda (IMEI kods nepareizs, lietotājs neeksistē utt):

					<pre class="json">
	[
		{
			"error": "Something happened!",
			"status": 21
		}
	]
					</pre>

								Statusi:
									<div class="tab2">
										<span class="key">21</span> - SHA1 nesakrīt, IMEI nepareizs<br>
										<span class="key">25</span> - lietotājs neeksistē
									</div>
			</div>

	</body>
</html>