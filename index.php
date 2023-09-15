<?php

require 'app/GameController.php';
require 'app/Models/Cell.php';
require 'app/Models/Table.php';

$width = (int)readline('Enter table width: ');
$height = (int)readline('Enter table height: ');

GameController::startGame($width, $height);