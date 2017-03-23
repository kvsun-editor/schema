<?php

namespace shgysk8zer0\Schema\Abstracts;

abstract class Item implements \JsonSerializable
{
	use \shgysk8zer0\Schema\Traits\Filters;
	const SCHEMA = 'http://schema.org';

	private $_data = [];

	final public function jsonSerialize()
	{
		return json_encode(array_merge([
			'@context' => self::SCHEMA,
			'@type'    => $this::ITEMTYPE,
		], $this->_data));
	}

	final protected function _set(String $prop, $value)
	{
		$this->_data[$prop] = $value;
	}

	final public function __get(String $prop)
	{
		return $this->_data[$prop] ?? null;
	}

	final protected function _add(String $prop, $value)
	{
		if (! array_key_exists($prop, $this->_data)) {
			$this->_data[$prop] = [$value];
		} elseif (! is_array($this->_data[$prop])) {
			$this->_data[$prop] = [$this->_data[$prop]];
			$this->_data[$prop][] = $value;
		} else {
			$this->_data[$prop][] = $value;
		}
	}

	final protected function _addAll(String $prop, Array $values)
	{
		foreach ($values as $value) {
			$this->_add($prop, $value);
		}
	}

	final public function __isset(String $prop): Bool
	{
		return array_key_exists($this->_data[$prop]);
	}

	final public function __unset(String $prop)
	{
		unset($this->_data[$prop]);
	}

	final public function getSchemaURL(): String
	{
		return $this::SCHEMA . '/' . $this::ITEMTYPE;
	}

}