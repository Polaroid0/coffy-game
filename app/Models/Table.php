<?php

namespace Models;

class Table
{
	public int $width;
	public int $height;
	public array $cells = [];

	public function __construct($width, $height)
	{
		$this->width = $width;
		$this->height = $height;

		for($i = 0; $i < $this->height; $i++) {
			for($j = 0; $j < $this->width; $j++) {
				$this->cells[] = new Cell($j, $i, rand(true, false));
			}
		}
	}

	public function outputInConsole(bool $showPuddleGroupNumber = false): void
	{
		$line = str_repeat("+-", $this->width) . "+";

		$text = $line . "\n";
		$row = 0;
		foreach($this->cells as $cell) {
			if($cell->yPosition !== $row) {
				$text .= "|" . "\n";
				$row = $cell->yPosition;
			}
			if($showPuddleGroupNumber) {
				$text .= "|" . $cell->puddleId;
			} else {
				if($cell->isDirty) {
					$text .= "|1";
				} else {
					$text .= "|0";
				}
			}
		}
		$text .= "|" . "\n" . $line . "\n";
		echo $text;
	}

	public function finalCount(): void
	{
		$puddleCount = 0;
		$biggestPuddle = 0;
		$biggestPuddleId = null;
		$counter = 1;

		foreach($this->cells as $cell) {
			if($cell->isDirty && !$cell->isChecked) {
				$cell->isChecked = true;
				$cell->puddleId = $counter;
				$puddleCount++;
				$puddleSize = $cell->getPuddleSize($this, $counter);
				if($puddleSize > $biggestPuddle) {
					$biggestPuddle = $puddleSize;
					$biggestPuddleId = $counter;
				}
				$counter++;
			}
		}

		echo "Najväčšia kávová kaluž je s číslom {$biggestPuddleId}.";
		echo PHP_EOL;
		echo "Kaluž je veľká {$biggestPuddle} políčok.";
		echo PHP_EOL;
		echo "Počet kaluží je: {$puddleCount}";
		echo PHP_EOL;
	}
}