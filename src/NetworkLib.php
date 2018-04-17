<?php

namespace dekuan\delavlib;


use dekuan\vdata\CResponse;
use dekuan\vdata\CRemote;
use dekuan\vdata\CConst;
use dekuan\delib\CLib;
use dekuan\delib\CEnv;
use dekuan\delib\CMobileDetector;



/**
 *	Class NetworkLib
 *	@package App\Http\Lib
 */
class NetworkLib
{
	/**
	 *	check if current browser is WeChat Browser
	 *	@return bool
	 */
	static function isBrowserWeChat()
	{
		$cMd	= new CMobileDetector();
		$sVer	= $cMd->version( 'MicroMessenger' );

		//	...
		return CLib::IsExistingString( $sVer );
	}

	/**
	 *	get safe remote source type
	 *	@return int
	 */
	static function getSafeSource()
	{
		$nSource = CRemote::GetSource();
		return CConst::IsValidSource( $nSource ) ? intval( $nSource ) : CConst::SOURCE_UNKNOWN;
	}

	/**
	 *	get safe app type
	 *	@return int
	 */
	static function getSafeAppType()
	{
		$nRet		= CConst::APP_TYPE_UNKNOWN;
		$nSource	= NetworkLib::getSafeSource();

		switch ( $nSource )
		{
			case CConst::SOURCE_ANDROID :
			case CConst::SOURCE_IOS :
			{
				//	mobile app
				$nRet = CConst::APP_TYPE_APP;
				break;
			}
			case CConst::SOURCE_WAP :
			case CConst::SOURCE_PC :
			default:
			{
				//	website
				$nRet = CConst::APP_TYPE_WEB;
				break;
			}
		}

		return $nRet;
	}


	/**
	 *	get safe HTTP scheme
	 *	@return string
	 */
	static function getSafeScheme()
	{
		return ( CEnv::IsSecureHttp() ? 'https' : 'http' );
	}

	/**
	 *	@param	array	$arrParam
	 *	@param	string	$sRootHost
	 *	@return string
	 */
	static function getSafeUrlRef( $arrParam, $sRootHost = '.dekuan.org' )
	{
		$sRet = '';

		if ( CLib::IsArrayWithKeys( $arrParam, [ 'ref' ] ) &&
			CLib::IsExistingString(  $arrParam[ 'ref' ] ) &&
			6 < strlen( $arrParam['ref'] ) )
		{
			$sTmp	= trim( $arrParam['ref'] );
			$arrUrl	= parse_url( $sTmp );
			if ( CLib::IsArrayWithKeys( $arrUrl, [ 'scheme', 'host' ] ) )
			{
				if ( CLib::IsExistingString( $arrUrl['scheme'] ) &&
					in_array( $arrUrl['scheme'], [ 'http', 'https' ] ) )
				{
					if ( CLib::IsExistingString( $sRootHost ) )
					{
						$sRootHost	= trim( $sRootHost );
						$nHostLen	= strlen( $sRootHost );
						$sSubStr	= substr( $arrUrl[ 'host' ], -1 * $nHostLen );

						if ( 0 == strcasecmp( $sRootHost, $sSubStr ) )
						{
							$sRet = $arrParam['ref'];
						}
					}
					else
					{
						$sRet = $arrParam['ref'];
					}
				}
			}
		}

		return $sRet;
	}
}