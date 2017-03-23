<?php

namespace shgysk8zer0\Schema;

class Rating extends Thing
{
	const ITEMTYPE = 'Rating';

	final public function setAuthor(Thing $author)
	{
		if ($author instanceof Person or $author instanceof Organization) {
			$this->_set('author', $author);
		} else {
			throw new \InvalidArgumentException(sprintf(
				'Author must be an instance of Person or Organization. Instance of %s given',
				get_class($author)
			));
		}
	}

	final public function setBestRating(Int $rating)
	{
		$this->_set('bestRating', $rating);
	}

	final public function setRating(Float $rating)
	{
		$this->_set('ratingValue', $rating);
	}

	final public function setWorstRating(Int $rating)
	{
		$this->_set('worstRating', $rating);
	}
}
