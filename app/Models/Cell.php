<?php

namespace Models;

class Cell
{
	public bool $isChecked = false;
	public int $puddleId = 0;
	public bool $isDirty;
	public int $xPosition;
	public int $yPosition;

	public function __construct($xPosition, $yPosition, $isDirty)
	{
		$this->xPosition = $xPosition;
		$this->yPosition = $yPosition;
		$this->isDirty = $isDirty;
	}

	public function getPuddleSize(Table $table, $id): int
	{
		$counter = 1;
		$queue[] = $this;

		while($queue) {
			foreach($queue as $key => $item) {
				foreach($table->cells as $cellTable) {
					if($cellTable->isDirty && !$cellTable->isChecked) {
						if($item->yPosition === $cellTable->yPosition && $item->xPosition === $cellTable->xPosition + 1) {
							$counter++;
							$cellTable->isChecked = true;
							$cellTable->puddleId = $id;
							$queue[] = $cellTable;
						}
						if($item->yPosition === $cellTable->yPosition + 1 && $item->xPosition === $cellTable->xPosition) {
							$counter++;
							$cellTable->isChecked = true;
							$cellTable->puddleId = $id;
							$queue[] = $cellTable;
						}
						if($item->yPosition === $cellTable->yPosition && $item->xPosition === $cellTable->xPosition - 1) {
							$counter++;
							$cellTable->isChecked = true;
							$cellTable->puddleId = $id;
							$queue[] = $cellTable;
						}
						if($item->yPosition === $cellTable->yPosition - 1 && $item->xPosition === $cellTable->xPosition) {
							$counter++;
							$cellTable->isChecked = true;
							$cellTable->puddleId = $id;
							$queue[] = $cellTable;
						}
						if($item->yPosition === $cellTable->yPosition - 1 && $item->xPosition === $cellTable->xPosition - 1) {
							$counter++;
							$cellTable->isChecked = true;
							$cellTable->puddleId = $id;
							$queue[] = $cellTable;
						}
						if($item->yPosition === $cellTable->yPosition + 1 && $item->xPosition === $cellTable->xPosition + 1) {
							$counter++;
							$cellTable->isChecked = true;
							$cellTable->puddleId = $id;
							$queue[] = $cellTable;
						}
						if($item->yPosition === $cellTable->yPosition + 1 && $item->xPosition === $cellTable->xPosition - 1) {
							$counter++;
							$cellTable->isChecked = true;
							$cellTable->puddleId = $id;
							$queue[] = $cellTable;
						}
						if($item->yPosition === $cellTable->yPosition - 1 && $item->xPosition === $cellTable->xPosition + 1) {
							$counter++;
							$cellTable->isChecked = true;
							$cellTable->puddleId = $id;
							$queue[] = $cellTable;
						}
					}
				}
				unset($queue[$key]);
			}
		}
		return $counter;
	}
}