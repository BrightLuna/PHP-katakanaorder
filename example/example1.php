<?php
require_once '../vendor/autoload.php';

use \sharapeco\KanaOrder\KanaOrder;

$items = [
	['name' => '費用', 'kana' => 'ひよう'],
	['name' => '雹', 'kana' => 'ひょう'],
	['name' => '鋲', 'kana' => 'びょう'],
	['name' => 'ぴょう', 'kana' => 'ぴょう'],
	['name' => '憑依', 'kana' => 'ひょうい'],
	['name' => '美容院', 'kana' => 'びよういん'],
	['name' => '病院', 'kana' => 'びょういん'],
	['name' => 'ピョートル・チャイコフスキー', 'kana' => 'ピョートルチャイコフスキー'],
	['name' => '鵯', 'kana' => 'ひよどり'],
	['name' => '飼育', 'kana' => 'しいく'],
	['name' => 'シーク', 'kana' => 'しーく'],
	['name' => '飼育員', 'kana' => 'しいくいん'],
	['name' => '勝つ', 'kana' => 'かつ'],
	['name' => 'カツ', 'kana' => 'カツ'],
];

// ソート用の情報を付加する
$items = array_map(function($item) {
	$item['sort_key'] = KanaOrder::get($item['kana']);
	return $item;
}, $items);

// ソートする
usort($items , function($x, $y) {
	return strcmp($x['sort_key'], $y['sort_key']);
});

// 結果を出力
echo implode('', array_map(function($item) {
	return sprintf('%s【%s】' . PHP_EOL, $item['kana'], $item['name']);
}, $items));
