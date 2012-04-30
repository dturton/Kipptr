<?php

namespace Kipptr;

/**
 * Lists API class
 *
 * @author		BrianLabs
 * @copyright	Copyright (c) 2012 BrianLabs
 * @license		http://unlicense.org/
 * @version		1.0.0
 * @package		Kipptr
 * @subpackage	Lists
 *
 */
class Lists extends Core {
	/**
	 * Create a new list
	 *
	 * @access	public
	 * @param	string	$title	List title
	 * @return	int
	 */
	public static function create($title) {
		return self::exec('lists', compact('title'), 'POST');
	}
	
	/**
	 * Get all lists
	 *
	 * @access	public
	 * @param	int	$id	List id
	 * @return	array|int
	 */
	public static function read($limit = 25, $offset = 1) {
		return self::exec('lists', compact('limit', 'offset'));
	}
	
	/**
	 * Get a single list
	 *
	 * @access	public
	 * @param	int	$id	List id
	 * @return	array|int
	 */
	public static function read_by_id($id, $limit = 25, $offset = 1) {
		return self::exec('lists/' . $id, compact('limit', 'offset'));
	}
	
	/**
	 * Update an existing list
	 *
	 * @access	public
	 * @param	int		$id		List id
	 * @param	string	$title	List title
	 * @return	int
	 */
	public static function update($id, $title) {
		return self::exec('lists/' . $id, compact('title'), 'PUT');
	}
	
	/**
	 * Delete a list
	 *
	 * @access	public
	 * @param	int	$id	List id
	 * @return	int
	 */
	public static function delete($id) {
		return self::exec('lists/' . $id, null, 'DELETE');
	}
}