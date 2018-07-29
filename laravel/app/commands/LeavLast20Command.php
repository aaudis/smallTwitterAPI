<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LeavLast20Command extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'app:leave-last-20';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Atstājam pēdējos 20 ieraktus';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->info('Deleting...');

		// savacam visus lietotaja atslegas vaardus
		$rs = DB::table('keywords')
					->select('imei_code', 'keyword')
					->get();

		// loopojam cauri atslegas vaardiem
		foreach($rs as $item)
		{
			// savacam pedeejo 20 ierakstu ID
			$id_list = array();

			$ms = DB::table('tweets')
						->select('id')
						->where('imei_code', '=', $item->imei_code)
						->orderBy('id', 'desc')
						->take(20)
						->get();

			foreach($ms as $m)
			{
				$id_list[] = $m->id;
			}

			// dzeesham ieraktus 20+
			if (!empty($id_list))
			{
				DB::table('tweets')
						->where('imei_code', '=', $item->imei_code)
						->whereNotIn('id', $id_list)
						->delete();
			}
		}

		$this->info('Done...');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
		// return array(
		// 	array('example', InputArgument::REQUIRED, 'An example argument.'),
		// );
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
		// return array(
		// 	array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		// );
	}

}
