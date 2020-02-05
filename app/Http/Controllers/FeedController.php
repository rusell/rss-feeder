<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedController extends Controller
{
	private $excludedWords = ['the','be','to','of','and','a','in','that','have','I','it','for','not','on','with','he','as','you','do','at','this','but','his','by','from','they','we','say','her','she','or','an','will','my','one','all','would','there','their','what','so','up','out','if','about','who','get','which','go','me'];
	//
	public function index(Request $request)
	{
		$url = "https://www.theregister.co.uk/software/headlines.atom";
		$feeds = simplexml_load_file($url); //download the RSS feed
		$myFeeds = []; //Feed timeline
		$dictionary = []; //Word count
		foreach ($feeds->entry as $element) {
			$tmp = [
				'id' => $element->id,
				'author' => (string)$element->author->name,
				'title' => (string)$element->title,
				'link' => (string)$element->link['href'],
				'summary' => strip_tags((string)$element->summary),
			];
			$myFeeds[] = $tmp; //append converted feed to timeline

			//Remove dots, commas and other bulky characters
			$text = preg_replace('/[^\w\s]+/', '', $tmp['title']);
			$text .= ' ' . preg_replace('/[^\w\s]+/', '', $tmp['summary']);

			$words = explode(' ', $text); //split text into array of words
			$words = array_diff($words, $this->excludedWords); //subtract unwanted words
			foreach ($words as $word) {
				if (is_numeric($word)) continue; //skip numbers
				if (isset($dictionary[$word])) {
					$dictionary[$word]++; //increase occurrence index
				} else {
					$dictionary[$word] = 1; //register new word
				}
			}
		}
		unset($dictionary['']); //remove empty word
		arsort($dictionary, 1); //sort
		$wordStats = [];
		$i = 1;
		foreach ($dictionary as $word => $count) { //retrieve only TOP10 words
			$wordStats[$word] = $count;
			$i++;
			if ($i > 10) break;
		}
		return view('feed', ['feeds' => $myFeeds, 'wordStats' => $wordStats]);
	}
}
