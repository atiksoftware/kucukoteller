<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	protected $attributes = [
		'key' => '', // [ type: string, required: true, max: 255 ]
		'value' => '', // [ type: string, dbType:text ]
		'type' => '', // [ type: string, required: true, max: 32 ]
		'option_group_id' => null, // [ type: integer, nullable, Model: OptionGroup ]
		'title' => null, // [ type: string, nullable, max: 255 ]
		'description' => null, // [ type: string, nullable, max: 255 ]
	];

	protected $casts = [
		'key' => 'string',
		'value' => 'string',
		'type' => 'string',
		'option_group_id' => 'integer',
		'title' => 'string',
		'description' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function option_group()
	{
		return $this->belongsTo(OptionGroup::class);
	}

	public static $handled_options;

	public static function getAll()
	{
		if (null === self::$handled_options) {
			self::$handled_options = self::all();
		}

		return self::$handled_options;
	}

	public static function get($key)
	{
		$options = self::getAll();
		foreach ($options as $option) {
			if ($option->key === $key) {
				switch ($option->type) {
					case 'json':
						return json_decode($option->value, true);
					case 'array':
						return json_decode($option->value, true);
					case 'boolean':
						return (bool) $option->value;
					case 'integer':
						return (int) $option->value;
					case 'float':
						return (float) $option->value;
					default:
						return $option->value;
				}
			}
		}

		return null;
	}

	public static function put($key, $value = null, $type = null, $option_group_id = null): void
	{
		$option = self::get($key);
		if (null === $type) {
			$type = 'string';
			if (null !== $option) {
				$type = $option->type;
			}
		}
		if (null === $option) {
			$option = new self();
		}
		$option->key = $key;
		$option->type = $type;
		$option->option_group_id = $option_group_id;

		switch ($type) {
			case 'json':
				$option->value = json_encode($value);
				break;
			case 'array':
				$option->value = serialize($value);
				break;
			case 'boolean':
				$option->value = $value ? 1 : 0;
				break;
			default:
				$option->value = $value;
				break;
		}

		$option->save();
	}
}
