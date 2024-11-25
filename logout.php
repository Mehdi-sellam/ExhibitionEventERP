<?php
require 'config/constants.php';

//close all sesion

session_destroy();
header('location: ' . ROOT_URL);
die();
