<?php
/**
 * @param string $string
 * @return stdClass
 */
function jsonToAssoc($string)
{
	return json_decode($string, true);
}

/**
 * @param string $string
 * @return array
 */
function jsonToStdClass($string)
{
	return json_decode($string);
}
