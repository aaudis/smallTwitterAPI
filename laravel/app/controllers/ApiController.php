<?php

class ApiController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function sayHello($name = "")
	{
		$view = View::make('api.api');
		$view->name = $name;

		if (str_contains($name, "ck")) {
			$view->name = $name . " (bad word)";
		}

		$view->text = nl2br(e("Lore<b>ā</b> ipsum dolor sit amet, consectetur adipiscing elit. Maecenas malesuada, mi sit amet accumsan ullamcorper, lorem odio congue ante, a tristique urna massa eget ipsum. Duis et hendrerit lectus. Vivamus gravida purus eros. Maecenas congue scelerisque dolor, id egestas leo faucibus ac. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed iaculis velit vitae ligula euismod consequat. Quisque a varius turpis, at eleifend mi. Nam in mi quis nulla faucibus pellentesque et et augue. Vestibulum mauris orci, ultrices vitae gravida quis, laoreet id elit.

Nunc scelerisque libero quis libero venenatis, vulputate ullamcorper felis hendrerit. Duis aliquet lacus eget libero volutpat dignissim. Cras imperdiet, massa pellentesque consequat fringilla, augue elit molestie augue, sit amet volutpat neque augue a tortor. Sed luctus non velit eu auctor. Phasellus mattis magna sed diam bibendum ornare. Aenean interdum id lacus nec tristique. Proin vitae dolor at tortor pharetra tempor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed blandit facilisis vehicula. Nam dignissim tellus ligula, et aliquet nisi suscipit quis.

Vestibulum varius porttitor metus, vel pharetra neque dignissim eget. Maecenas dictum, risus a dapibus rutrum, dui urna hendrerit lacus, non sagittis ligula mauris vitae urna. Duis mattis nunc elit, eget aliquam erat adipiscing non. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi posuere dignissim ipsum egestas euismod. Quisque quam massa, vehicula nec ipsum bibendum, sodales pretium risus. Etiam sollicitudin ultricies erat, sed tincidunt est varius eu. Mauris commodo velit id erat lacinia mattis. Donec porta nulla blandit, mattis arcu et, varius quam. Pellentesque lorem mauris, venenatis et imperdiet sit amet, sagittis non diam. Integer aliquam accumsan urna, at dictum sem ullamcorper sit amet. Donec interdum pharetra molestie.

Nullam cursus metus auctor quam dignissim pharetra. Mauris vestibulum vitae tortor vel aliquet. Nam quis neque varius nisi placerat pretium. Suspendisse malesuada, odio ac iaculis mattis, odio ligula tristique tortor, at porta eros nibh ac risus. Fusce sodales commodo mi, id varius ipsum fringilla non. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur mollis fermentum gravida.

Ut gravida ac diam ac commodo. Ut sed odio ullamcorper, dapibus mauris vitae, egestas leo. Sed et condimentum dolor. Cras aliquam feugiat feugiat. Integer aliquet eget dui vitae lobortis. In ac diam id justo venenatis lacinia. Maecenas sed vulputate dolor. Cras et dui a arcu volutpat placerat. In nec cursus orci, vel porta nulla. Ut ut mattis ipsum, eu tempus elit. Vestibulum ut dui eu nisl luctus luctus. Sed quis metus vitae odio blandit laoreet nec at quam. Quisque consectetur gravida dui ut laoreet. Curabitur rhoncus et orci quis congue. Sed sed erat condimentum, cursus ipsum sit amet, condimentum felis. Nunc mollis, urna vitae eleifend placerat, nibh eros porta erat, ut tristique eros eros quis velit."));

		$view->small_text = str_limit($view->text, 14);
		$view->random = str_random(40);

		return $view;
	}

}
