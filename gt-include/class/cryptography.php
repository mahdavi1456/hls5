<?php
class cryptography
{
	public function set_hash($string)
    {
		return md5($string);
	}
}