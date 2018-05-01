<?php

namespace dekuan\delavlib;



/**
 *	Created by PhpStorm.
 *	User: xing
 *	Date: 16:09, December 25, 2017
 */
class DeDateTimeLibTest extends \PHPUnit\Framework\TestCase
{
	public function test_getCurrentWeekDayIndex()
	{
		$this->assertEquals( intval( date( "w" ) ), DeDateTimeLib::getCurrentWeekDayIndex() );
	}

	public function test_getISODateString1()
	{
		$this->assertEquals( date( "Y-m-d" ), DeDateTimeLib::getISODateString() );
	}
	public function test_getISODateString2()
	{
		$sDate1	= '2018-11-11';
		$nTime1	= strtotime( $sDate1 );
		$this->assertEquals( $sDate1, DeDateTimeLib::getISODateString( $nTime1 ) );
	}

	public function test_getTimeWithNowTime2()
	{
		$sDate1	= '2018-11-11 11:11:11';
		$nTime1	= strtotime( $sDate1 );
		$this->assertEquals( $nTime1, DeDateTimeLib::getTimeWithNowTime( $nTime1 ) );
	}

	
	public function test_isToday1()
	{
		$this->assertEquals
		(
			true,
			DeDateTimeLib::isToday( DeDateTimeLib::getISODateString() )
		);
	}
	public function test_isToday2()
	{
		$this->assertEquals
		(
			true,
			DeDateTimeLib::isToday( DeDateTimeLib::getISODateTimeString() )
		);
	}
	
	
	public function test_isFuture1()
	{
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isFuture( DeDateTimeLib::getISODateTimeString() )
		);
	}
	public function test_isFuture2()
	{
		$sDateFuture1	= date("Y-m-d H:i:s", strtotime("+30 minutes" ) );
		$this->assertEquals
		(
			true,
			DeDateTimeLib::isFuture( $sDateFuture1 )
		);
	}
	public function test_isFuture3()
	{
		$this->assertEquals
		(
			true,
			DeDateTimeLib::isFuture( '2019-11-11' )
		);
	}
	public function test_isFuture4()
	{
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isFuture( '2011-11-11' )
		);
	}
	public function test_isFuture5()
	{
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isFuture( '2011' )
		);
	}


	public function test_isPast1()
	{
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isPast( DeDateTimeLib::getISODateTimeString() )
		);
	}
	public function test_isPast2()
	{
		$sDateFuture1	= date("Y-m-d H:i:s", strtotime("+30 minutes" ) );
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isPast( $sDateFuture1 )
		);
	}
	public function test_isPast3()
	{
		$sDateFuture1	= date("Y-m-d H:i:s", strtotime("-1 minutes" ) );
		$this->assertEquals
		(
			true,
			DeDateTimeLib::isPast( $sDateFuture1 )
		);
	}
	public function test_isPast4()
	{
		$this->assertEquals
		(
			true,
			DeDateTimeLib::isPast( '2011-11-11' )
		);
	}
	public function test_isPast5()
	{
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isPast( '2028-11-11' )
		);
	}
	
	public function test_isValidISODateString1()
	{
		$this->assertEquals
		(
			true,
			DeDateTimeLib::isValidISODateString( '2011-11-11' )
		);
	}
	public function test_isValidISODateString2()
	{
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isValidISODateString( '' )
		);
	}
	public function test_isValidISODateString3()
	{
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isValidISODateString( '2011-11-11 11:11:11' )
		);
	}
	
	
	public function test_isValidISODateTimeString1()
	{
		$this->assertEquals
		(
			true,
			DeDateTimeLib::isValidISODateTimeString( '2011-11-11 11:11:11' )
		);
	}
	public function test_isValidISODateTimeString2()
	{
		$this->assertEquals
		(
			false,
			DeDateTimeLib::isValidISODateTimeString( '' )
		);
	}



}