<?php
namespace sharapeco\KanaOrder;

class KanaOrder {

	// 変換テーブル
	protected static $kanaOrderTable = array(
		array(
			'org' => 'アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヰヱヲン',
			'nom' => 'あいうえおかきくけこさしすせそたちつてとなにぬねのはひふへほまみむめもやゆよらりるれろわゐゑをん',
			'mark' => '!',
		),
		array(
			'org' => 'がぎぐげござじずぜぞだぢづでどばびぶべぼ',
			'nom' => 'かきくけこさしすせそたちつてとはひふへほ',
			'mark' => '"',
		),
		array(
			'org' => 'ガギグゲゴザジズゼゾダヂヅデドバビブベボヴ',
			'nom' => 'かきくけこさしすせそたちつてとはひふへほう',
			'mark' => '#',
		),
		array(
			'org' => 'ぱぴぷぺぽぁぃぅぇぉっゃゅょゎ',
			'nom' => 'はひふへほあいうえおつやゆよわ',
			'mark' => '$',
		),
		array(
			'org' => 'パピプペポァィゥェォッャュョヮ',
			'nom' => 'はひふへほあいうえおつやゆよわ',
			'mark' => '%',
		),
	);

	/// @param kana: String
	public static function get($kana) {

		// Unicode 結合文字を合成済み文字に変換する
		$kana = \Patchwork\Utf8::filter($kana);

		// 長音符を小書きのあいうえおに置換する
		$kana = preg_replace('/([あぁかがさざただまはばぱまやゃらわ])ー/u', '$1ぁ', $kana);
		$kana = preg_replace('/([いぃきぎしじちぢにひびぴみりゐ])ー/u', '$1ぃ', $kana);
		$kana = preg_replace('/([うぅくぐすずつづぬふぶぷむゆゅる])ー/u', '$1ぅ', $kana);
		$kana = preg_replace('/([えぇけげせぜてでねへべぺめれゑ])ー/u', '$1ぇ', $kana);
		$kana = preg_replace('/([おぉこごそぞとどのほぼぽもよょろを])ー/u', '$1ぉ', $kana);
		$kana = preg_replace('/([アァカガサザタダマハバパマヤャラワ])ー/u', '$1ァ', $kana);
		$kana = preg_replace('/([イィキギシジチヂニヒビピミリヰ])ー/u', '$1ィ', $kana);
		$kana = preg_replace('/([ウゥクグスズツヅヌフブプムユュルヴ])ー/u', '$1ゥ', $kana);
		$kana = preg_replace('/([エェケゲセゼテデネヘベペメレヱ])ー/u', '$1ェ', $kana);
		$kana = preg_replace('/([オォコゴソゾトドノホボポモヨョロヲ])ー/u', '$1ォ', $kana);

		// 付加情報を付ける
		$skana = '';
		$marks = '';
		$pos = 0;
		while (preg_match('/./u', $kana, $matches, 0, $pos)) {
			$c = $matches[0];
			$pos += strlen($c);
			$converted = false;
			foreach (self::$kanaOrderTable as $kanaOrder) {
				if (($p = strpos($kanaOrder['org'], $c)) !== false) {
					$skana .= substr($kanaOrder['nom'], $p, strlen($c));
					$marks .= $kanaOrder['mark'];
					$converted = true;
					break;
				}
			}
			if (!$converted) {
				$skana .= $c;
				$marks .= ' ';
			}
		}
		return $skana . $marks;
	}

}
