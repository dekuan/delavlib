<?php

namespace dekuan\delavlib;

use dekuan\delib\CLib;



/**
 *	Class DeCacheLib
 *	@package App\Http\Lib
 */
class DeCacheLib
{
	/***
	 *	@param	string	$sNamespace
	 *	@param	string	$sSubKey
	 *	@param	int	$nUMId
	 *	@return	string
	 */
	static function getCacheKey( $sNamespace, $sSubKey, $nUMId = 0 )
	{
		if ( ! CLib::IsExistingString( $sSubKey ) )
		{
			return '';
		}

		//	...
		return sprintf
		(
			"%s-%s-%d",
			strval( $sNamespace ),
			strval( $sSubKey ),
			intval( $nUMId )
		);
	}

}