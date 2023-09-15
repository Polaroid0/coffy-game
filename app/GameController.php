<?php

use Models\Table;

class GameController
{
	public static function startGame(int $width, int $height): void
	{
		$table = new Table($width, $height);
		$table->outputInConsole();
		$table->finalCount();
		$table->outputInConsole(true);
	}
}