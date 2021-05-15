<?php

namespace App\Controllers;

use Exception;
use voku\helper\HtmlDomParser;

class Home extends BaseController
{

	public function __construct()
	{
		helper('filesystem');
	}

	public function index()
	{

		$page = intval($this->request->getPostGet("page")) ?: 1;
		$chunk = intval($this->request->getPostGet("count")) ?: 9;

		$projects = $this->__getProjectDirs();
		$total = count($projects);

		//ensure we get projects between 0 and total chunk$chunk - required number
		//$start = min(max($page - 1, 0) * $chunk, $total - ($chunk - fmod($total, $chunk)));

		$projects = array_chunk($projects, $chunk)[$page - 1];
		$mobile = $this->request->getUserAgent()->isMobile();

		$data = compact("projects",	"page",	"total", "chunk", "mobile");

		return view('projects', $data);
	}

	public function detail()
	{
		$slug = $this->request->getPostGet("slug");

		try {
			timer('load_site');

			$html = $this->__getHtml(root_url($this->__escapeUrl($slug)));

			timer('load_site');

			//get html dom
			$dom = HtmlDomParser::str_get_html($html);

			return $this->response->setJSON(array(
				"title" => $this->__getTitle($dom) ?: $slug,
				"description" => $this->__getDescription($dom),
				"sreenshot" => $this->__getScreenShot($dom),
				"icon" => $this->__getIcon($dom),
				"time" => timer()->getElapsedTime('load_site'),
				"url" => $this->__getUrl($dom) ?: root_url($this->__escapeUrl($slug))
			));
		} catch (\Exception $e) {
			//return $this->response->setJSON(array("exception" => $e->getMessage()));
			return $this->response->setJSON(array(
				"title" =>  $slug,
				"description" => "&nbsp;",
				"sreenshot" => "",
				"icon" => "",
				"time" => timer()->getElapsedTime('load_site'),
				"url" => $this->__getUrl($dom) ?: root_url($this->__escapeUrl($slug))
			));
		}
	}

	private function __getHtml($target)
	{
		$headers[] = "User-Agent:" . $this->request->getUserAgent()->getAgentString();
		$headers[] = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
		$headers[] = "Accept-Language:en-us,en;q=0.5";
		$headers[] = "Accept-Encoding:gzip,deflate";
		$headers[] = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$headers[] = "Keep-Alive:115";
		$headers[] = "Connection:keep-alive";
		$headers[] = "Cache-Control:max-age=0";

		// create curl resource
		$ch = curl_init();

		// set url
		curl_setopt($ch, CURLOPT_URL, $target);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		// $output contains the output string
		$html = curl_exec($ch);

		if (curl_error($ch)) {
			throw new Exception(curl_error($ch));
		}

		// close curl resource to free up system resources
		curl_close($ch);

		return $html;
	}

	private function __getTitle($dom)
	{

		$possible = array(
			array("meta[property='og:title']", "content"),
			array("title", ""),
		);

		return  $this->__getField($dom, $possible);
	}

	private function __getDescription($dom)
	{

		$possible = array(
			array("meta[property='og:description']", "content"),
			array("meta[name='description']", "content"),
		);

		return  $this->__getField($dom, $possible) ?: "&nbsp;";
	}

	private function __getScreenShot($dom)
	{

		$possible = array(
			array("meta[property='og:image']", "content"),
		);

		return  $this->__getField($dom, $possible);
	}

	private function __getUrl($dom)
	{

		$possible = array(
			array("meta[property='og:url']", "content"),
		);

		return  $this->__getField($dom, $possible);
	}

	private function __getIcon($dom)
	{

		$possible = array(
			array("link[rel='icon']", "href"),
		);

		return  $this->__getField($dom, $possible) ?: "favicon.ico";
	}

	private function __getField($dom, $possible = array())
	{
		$data = "";
		foreach ($possible as $item) {
			$data = $this->__findField($dom, $item[0], $item[1]);

			if ($data != "") {
				break;
			}
		}

		return  $data;
	}

	private function __findField($dom, $selector, $attr = "")
	{

		$element = $dom->findOneOrFalse($selector);

		if ($element !== false) {
			if ($attr != "" && $element->hasAttribute($attr)) {
				return $element->getAttribute($attr);
			} else {
				return $element->innerhtml();
			}
		} else {
			return "";
		}
	}

	private function __escapeUrl($url)
	{
		return str_replace(" ", '%20', $url);
	}

	private function __getProjectDirs()
	{
		$projects = array_filter(directory_map(root_dir(), 1), function ($dir) {
			return is_dir(root_dir(DIRECTORY_SEPARATOR . $dir)) && basename($dir) != basedir();
		});

		$projects = array_map(function ($dir) {
			return trim($dir, "\\/");
		}, $projects);

		sort($projects, SORT_STRING | SORT_FLAG_CASE);

		return $projects;
	}
}
