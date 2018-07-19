<?php
namespace Edu\Cnm\DataDesign;
use Ramsey\Uuid\Uuid;
/**
 * Small Cross Section of the Goodreads site genre menu.
 *
 * This is a small example of what sites like Goodreads displays when a user clicks on the genres link and a list of
 * genre types are displayed.
 * This can easily be extended to emulate more features of Goodreads.
 *
 * @author Joseph Isbell <jisbell1@cnm.edu>
 * @version 1.0.0
 **/
class Genre {
	use ValidateUuid;
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
	 * Constructor method for Genre class
	 *
	 * @param string|Uuid $newGenreId id of this genre or null if new genre
	 * @param string $newGenreType string containing type of genre
	 * @throws \InvalidArgumentException if data types are invalid
	 * @throws \RangeException if values are out of bounds(e.g.; strings are too long)
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 */
	public function __construct($newGenreId, $newGenreType) {
		try {
			$this->setGenreId($newGenreId);
			$this->setGenreType($newGenreType);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

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
	//Passes value into function. Void does not require it return anything
	public function setGenreId($newGenreId) : void {
		try {
			//Validates the Uuid and stores it to $uuid variable
			$uuid = self::validateUuid($newGenreId);
			//If value returns an exception, throws error message based on exception caught
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//Converts and stores the genre id into new variable if passes validation
		$this->genreId = $uuid;
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

	// passes value into the function only if its type is a string. Void causes nothing to be expected to return
	public function setGenreType(string $newGenreType) : void {
		//Verify the genre type is secure by trimming white space and filtering added html tags and special characters ASCII > 127
		$newGenreType = trim($newGenreType);
		$newGenreType = filter_var($newGenreType, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		//Verify the input is not empty and throw error message if it is
		if(empty($newGenreType) === true) {
			throw(new \InvalidArgumentException("Genre type cannot be empty"));
		}
		//Verify the input will not exceed the set character limit
		if(strlen($newGenreType) > 128) {
			throw(new \RangeException("The genre type has exceed the character limit"));
		}
		//Store value once it passes validation
		$this->genreType = $newGenreType;
	}
}
