<?php
use Pusher\Pusher;

//PUSHER
function getPusher()
{
	return new Pusher(
        getenv('pusher_Key'),
        getenv('pusher_secret'),
        getenv('pusher_app_id'),
        ['cluster' => getenv('pusher_cluster')]
    );
}