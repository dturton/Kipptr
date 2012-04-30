<?php

namespace Kipptr;

/**
 * Clips API class
 *
 * @author		BrianLabs
 * @copyright	Copyright (c) 2012 BrianLabs
 * @license		http://unlicense.org/
 * @version		1.0.0
 * @package		Kipptr
 * @subpackage	Clips
 *
 */
class Clips extends Core {
	/**
	 * Create a new clip
	 *
	 * @access	public
	 * @param	string	$url		Clip url
	 * @param	string	$title		Clip title
	 * @param	string	$list		Clip list resource identifier
	 * @param	string	$notes		Notes for the clip
	 * @param	bool	$starred	Is the clip starred or not (true/false)
	 * @return	int
	 */
	public static function create($url, $title = null, $list = null, $notes = null, $starred = false) {
		return self::exec('clips', compact('url', 'title', 'list', 'notes', 'starred'), 'POST');
	}
	
	/**
	 * Get all clips
	 *
	 * @access	public
	 * @param	int	$id	Clip id
	 * @return	array|int
	 */
	public static function read($limit = 25, $offset = 0) {
		return self::exec('clips', compact('limit', 'offset'));
	}
	
	/**
	 * Get a clip from a list
	 *
	 * @access	public
	 * @param	int	$id	Clip id
	 * @return	array|int
	 */
	public static function read_by_list($list, $limit = 25, $offset = 0) {
		return self::exec('clips', compact('list', 'limit', 'offset'));
	}
	
	/**
	 * Update an existing clip
	 *
	 * @access	public
	 * @param	int		$id			Clip id
	 * @param	string	$url		Clip url
	 * @param	string	$title		Clip title
	 * @param	string	$list		Clip list resource identifier
	 * @param	string	$notes		Notes for the clip
	 * @param	bool	$is_starred	Is the clip starred or not (true/false)
	 * @return	int
	 */
	public static function update($id, $url, $title = null, $list = null, $notes = null, $is_starred = null) {
		return self::exec('clips/' . $id, compact('url', 'title', 'list', 'notes', 'is_starred'), 'PUT');
	}
	
	/**
	 * Delete an clip
	 *
	 * @access	public
	 * @param	int	$id	Clip id
	 * @return	int
	 */
	public static function delete($id) {
		return self::exec('clips/' . $id, null, 'DELETE');
	}
	
	/**
	 * Check if user is authenticating correctly
	 *
	 * @access	public
	 * @return	array|int
	 */
	public static function search($q, $limit = 25, $offset = 0, $include_data = false, $list = null, $is_starred = false) {
		return self::exec('search/clips', compact('q', 'list', 'is_starred', 'limit', 'offset', 'include_data'));
	}
}