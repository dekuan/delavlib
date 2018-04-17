<?php

namespace dekuan\delavlib;

use dekuan\delib\CLib;



/***
 *	Class DeCommonLib
 *	@package App\Http\Lib
 */
class DeCommonLib
{
	/**
	 *	@param	int	$nAvailableSeconds
	 *	@return string
	 */
	static function getTimePassword( $nAvailableSeconds = 3600 )
	{
		if ( 0 == intval( $nAvailableSeconds ) )
		{
			return '';
		}

		$sSource	= strval( time() / intval( $nAvailableSeconds ) );
		$nCrc32		= crc32( $sSource );
		$sResult	= strval( abs( $nCrc32 ) ); 
		return substr( $sResult, 0, 4 );
	}


	/**
	 *	@param	$sStr
	 *	@return bool
	 */
	static function isValidFilename( $sStr )
	{
		//
		//	sStr	- [in] string
		//	RETURN	- true / false
		//
		$bRet = false;
		$sStdChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_";

		if ( CLib::IsExistingString( $sStr, true ) )
		{
			$sStr		= trim( $sStr );
			$nStrLength	= strlen( $sStr );
			$nErrorCount	= 0;
			for ( $i = 0; $i < $nStrLength; $i ++ )
			{
				$cChr = substr( $sStr, $i, 1 );
				if ( ! strstr( $sStdChars, $cChr ) )
				{
					$nErrorCount ++;
					break;
				}
			}

			//	...
			$bRet = ( 0 == $nErrorCount ? true : false );
		}

		return $bRet;
	}


	/**
	 *	@param	$sDirection
	 *	@return bool
	 */
	static function isValidOrderByDirection( $sDirection )
	{
		return ( CLib::IsExistingString( $sDirection ) &&
			( 0 == strcasecmp( 'DESC', $sDirection ) || 0 == strcasecmp( 'ASC', $sDirection ) ) );
	}


	/**
	 *	@param	$vJson
	 *	@param	$vKey
	 *	@return	string
	 */
	static function getJsonItemValue( $vJson, $vKey )
	{
		$sRet = '';

		if ( is_string( $vKey ) || is_numeric( $vKey ) )
		{
			if ( is_string( $vJson ) )
			{
				$vJson = @ json_decode( $vJson, true );
			}
			if ( CLib::IsArrayWithKeys( $vJson, $vKey ) )
			{
				$sRet = $vJson[ $vKey ];
			}
		}

		return $sRet;
	}


	/**
	 *	@param	$sMobile
	 *	@return	string
	 */
	static function getClearChinaPhoneNumber( $sMobile )
	{
		if ( ! CLib::IsExistingString( $sMobile ) )
		{
			return '';
		}

		//	...
		$sRet		= '';
		$nStrLength	= strlen( $sMobile );
		for ( $i = 0; $i < $nStrLength; $i ++ )
		{
			$cChr = substr( $sMobile, $i, 1 );
			if ( is_numeric( $cChr ) )
			{
				$sRet .= $cChr;
			}
		}

		return substr( $sRet, -11 );
	}



}