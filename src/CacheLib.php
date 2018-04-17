<?php

namespace dekuan\delavlib;

use dekuan\delib\CLib;



/**
 *	Class CacheLib
 *	@package App\Http\Lib
 */
class CacheLib
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