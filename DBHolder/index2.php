<?php

	$data = '2021-07-24 11:43:02';
	$createDate = new DateTime($data);
	$strip = $createDate->format('Y-m-d');
	echo ($strip);




?>