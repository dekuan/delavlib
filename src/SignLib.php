<?php

namespace dekuan\delavlib;

use dekuan\delib\CLib;


/**
 *	Class SignLib
 *	@package App\Http\Lib
 */
class SignLib
{
	/**
	 *	@param	array	$arrData
	 *	@param	string	$sKey
	 *	@return string
	 */
	static function createCommonSign( $arrData, $sKey = '' )
	{
		$sRet	= '';
		$sKey	= trim( strval( $sKey ) );
		$sSrc	= '';

		if ( CLib::IsArrayWithKeys( $arrData ) )
		{
			foreach ( $arrData as $nIndex => $vValue )
			{
				$arrData[ $nIndex ] = trim( strval( $vValue ) );
			}

			if ( ! CLib::IsExistingString( $sKey ) )
			{
				$sKey	= date( "Y-m-d" );	
			}

			//	...
			$sSrc	= sprintf( "common-%s-%s", $sKey, implode( '|||', $arrData ) );
			$sRet	= md5( $sSrc );
		}

		return $sRet;
	}


	/**
	 *	@param	array	$arrData
	 *	@param	string	$sSign
	 *	@param	string	$sKey
	 *	@return	bool
	 */
	static function isValidCommonSign( $arrData, $sSign, $sKey = '' )
	{
		$sCalcSign	= self::createCommonSign( $arrData, $sKey );
		return CLib::IsCaseSameString( $sCalcSign, $sSign );
	}


}