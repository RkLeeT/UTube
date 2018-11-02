<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Comment;


function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
	if($parent_id == 0)
	{
		$marginleft = 0;
	}
	else
	{
		$marginleft = $marginleft + 48;
	}

	return $marginleft;
}


