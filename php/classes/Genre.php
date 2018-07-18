<?php

/**
 * Small Cross Section of the Goodreads site.
 *
 * This is a small example of what sites like Goodreads displays when a user clicks on the genres link and a list of
 books are displayed.
 * This can easily be extended to emulate more features of Goodreads.
 *
 * @author Joseph Isbell <jisbell1@cnm.edu>
 * @version 1.0.0
 **/
class Genre {

	/**
	 * id for this Genre, this is the primary key
	 * @var Uuid $genreId
	 **/
	private $genreId;
	/**
	 * The type of the genre, i,e; Mystery, Romance, etc.
	 * @var string
	 */
	private $genreType;


	/**
	 *Accessor method for genre id
	 *
	 *@return Uuid value of genre id
	 **/
	public function getGenreId() : Uuid {
		return($this->genreId);
	}

	/**
	 * Mutator method for genre id
	 *
	 * @param Uuid/string $newGenreId new value of genre id
	 * @throws \RangeException if $newGenreId is not a positive number
	 * @throws \TypeError if $newGenreId is not a Uuid
	 **/
	public function setGenreId($newGenreId) : void {
		try {
			//Validates the Uuid and stores it to $uuid variable
			$uuid = self::validateUuid($newGenreId);
			//If value returns an exception, throws error message based on exception caught.
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//Converts and stores the genre id into new variable if passes validation
		$this->$genreId = $uuid;
	}

	/**
	 * Accessor method for genre type.
	 *
	 * @return string value of genre type.
	 */
	public function getGenreType() : string {
		return($this->genreType);
	}

	/**
	 * Mutator method for genre type.
	 *
	 * @param string $newGenreType new value of genre type
	 * @throws \InvalidArgumentException if $newGenreType is not a string or insecure
	 * @throws \RangeException if $newGenreType is > 128 characters
	 * @throws \TypeError if $newGenreType is not a string
	 */
}