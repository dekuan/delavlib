<?php

namespace dekuan\delavlib;

use dekuan\delib\CLib;
use dekuan\delib\CMIdLib;
use dekuan\vdata\CRemote;


/**
 *	Class DeParameterLib
 *	@package App\Http\Lib
 */
class DeParameterLib
{
	/**
	 *	default values
	 */
	const DEFAULT_PAGE			= 1;		//	page number
	const DEFAULT_PAGE_SIZE			= 10;		//	page size

	

	//
	//	get safe page
	//

	/**
	 *	@param	int	$nPage
	 *	@param	int	$nDefault
	 *	@return int
	 */
	static function getSafePage( $nPage, $nDefault = self::DEFAULT_PAGE )
	{
		return ( is_numeric( $nPage ) && $nPage > 0 ) ? intval( $nPage ) : $nDefault;
	}

	/**
	 *	@param	int	$nPageSize
	 *	@param	int	$nDefault
	 *	@return int
	 */
	static function getSafePageSize( $nPageSize, $nDefault = self::DEFAULT_PAGE_SIZE )
	{
		return ( is_numeric( $nPageSize ) && $nPageSize > 0 ) ? intval( $nPageSize ) : $nDefault;
	}

	/**
	 *	@param	int	$nPage
	 *	@param	int	$nPageSize
	 *	@return int
	 */
	static function getSafePageStart( $nPage, $nPageSize )
	{
		return self::getSafePageSize( $nPageSize ) * ( self::getSafePage( $nPage ) - 1 );
	}

	/**
	 *	@param $arrAddress
	 *	@return array|null
	 */
	static function getCorrectedChinaRegionsValues( $arrAddress )
	{
		$arrRet	= null;

		if ( CLib::IsArrayWithKeys(
			$arrAddress,
			[ 'province_name', 'province_id', 'city_name', 'city_id', 'district_name', 'district_id', 'detail' ]
		) )
		{
			$arrRet	=
			[
				'province_name'	=> $arrAddress[ 'province_name' ],
				'province_id'	=> intval( $arrAddress[ 'province_id' ] ),
				'city_name'	=> $arrAddress[ 'city_name' ],
				'city_id'	=> intval( $arrAddress[ 'city_id' ] ),
				'district_name'	=> $arrAddress[ 'district_name' ],
				'district_id'	=> intval( $arrAddress[ 'district_id' ] ),
				'detail'	=> $arrAddress[ 'detail' ],
			];	
		}

		return $arrRet;
	}


	/**
	 *	@param	$objRecord
	 *	@param	$sPropertyName
	 *	@return array
	 */
	static function decodeDbJsonArray( $objRecord, $sPropertyName )
	{
		$arrRet	= [];

		if ( CLib::IsObjectWithProperties( $objRecord, $sPropertyName ) &&
			CLib::IsExistingString( $objRecord->{ $sPropertyName } ) )
		{
			$arrRet = CLib::DecodeObject( $objRecord->{ $sPropertyName }, CLib::ENCODEOBJECT_TYPE_JSON );
		}
		
		return is_array( $arrRet ) ? $arrRet : [];
	}

}