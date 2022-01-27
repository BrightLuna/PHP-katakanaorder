<?php

use PHPUnit\Framework\TestCase;
use sharapeco\KanaOrder\KanaOrder;

class KanaOrderTest extends TestCase
{
	/**
	 * @test
	 */
	public function onlyAlphaNum()
	{
		$this->assertEquals('KanaOrder         ', KanaOrder::get('KanaOrder'));
	}

	/**
	 * @test
	 */
	public function seion()
	{
		$this->assertEquals('すすめ   ', KanaOrder::get('すすめ'));
	}

	/**
	 * @test
	 */
	public function dakuon()
	{
		$this->assertEquals('すすめ " ', KanaOrder::get('すずめ'));
	}

	/**
	 * @test
	 */
	public function dakuonUN()
	{
		$this->assertEquals('すすめ " ', KanaOrder::get('すす' . "\xE3\x82\x99" . 'め'));
	}

	/**
	 * @test
	 */
	public function handakuon()
	{
		$this->assertEquals('はたはた$ $ ', KanaOrder::get('ぱたぱた'));
	}

	/**
	 * @test
	 */
	public function handakuonUN()
	{
		$this->assertEquals('はたはた$ $ ', KanaOrder::get('は' . "\xE3\x82\x9A" . 'たぱた'));
	}

	/**
	 * @test
	 */
	public function youon()
	{
		$this->assertEquals('ちゆん $ ', KanaOrder::get('ちゅん'));
	}

	/**
	 * @test
	 */
	public function choompu()
	{
		$this->assertEquals('しいう"$ ', KanaOrder::get('じーう'));
	}

	/**
	 * @test
	 */
	public function katakana()
	{
		$this->assertEquals('すすめ!!!', KanaOrder::get('ススメ'));
	}

	/**
	 * @test
	 */
	public function katakanaDakuon()
	{
		$this->assertEquals('すすめ!#!', KanaOrder::get('スズメ'));
	}

	/**
	 * @test
	 */
	public function katakanaHandakuon()
	{
		$this->assertEquals('はたはた%!%!', KanaOrder::get('パタパタ'));
	}

	/**
	 * @test
	 */
	public function katakanaYouon()
	{
		$this->assertEquals('ちゆん!%!', KanaOrder::get('チュン'));
	}

	/**
	 * @test
	 */
	public function katakanaChoompu()
	{
		$this->assertEquals('しいう#%!', KanaOrder::get('ジーウ'));
	}
}
