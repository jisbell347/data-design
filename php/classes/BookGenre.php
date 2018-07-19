<?php
namespace Edu\Cnm\DataDesign;

require_once ("autoload.php");
require_once (dirname(__DIR__, 2 ) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
* Small Cross Section of the Goodreads site book section within a genre.
*
* This is a small example of what sites like Goodreads displays when a user clicks on a specific book which brings them
* to that book's page. The book then lists additional genres that the book can belong to.
* This can easily be extended to emulate more features of Goodreads.
*
* @author Joseph Isbell <jisbell1@cnm.edu>
* @version 1.0.0
**/

class BookGenre {
	use ValidateUuid;
	/**
	 * id for the book genre. This is the primary key
	 */
	private $bookGenreId;

	/**
	 * id for the book id inside the book genre. This is a foreign key
	 */
	private $bookGenreBookId;

	/**
	 * id for the genre id inside the book genre. This is a foreign key.
	 */
	private $bookGenreGenreId;

	/**
	 * Constructor for BookGenre class
	 *
	 * @param Uuid|string $newBookGenreId sets the id for the book genre
	 * @param Uuid|string $newBookGenreBookId sets the id for the book within the book genre
	 * @param Uuid|string $newBookGenreGenreId sets the id for the genre within the book genre
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if values are out of bounds (e.g; strings are too long)
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 */
	public function __construct($newBookGenreId, $newBookGenreBookId, $newBookGenreGenreId) {
		try {
			$this->setBookGenreId($newBookGenreId);
			$this->setBookGenreBookId($newBookGenreBookId);
			$this->setBookGenreGenreId($newBookGenreGenreId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * Accessor for the book genre id
	 *
	 * @return Uuid value of book genre id
	 */
	public function getBookGenreId() : Uuid {
		return($this->bookGenreId);
	}

	/**
	 * Mutator for the book genre id
	 *
	 * @param Uuid/string $newBookGenreId new value of book genre id
	 * @throws \RangeException if value is not positive
	 * @throws \TypeError if value is not Uuid
	 */
	public function setBookGenreId($newBookGenreId) : void {
		try {
			$uuid = self::validateUuid($newBookGenreId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//Converts and stores the book genre id
		$this->bookGenreId = $uuid;
	}

	/**
	 * Accessor for the book genre book id
	 *
	 * @return Uuid value of book genre book id
	 */
	public function getBookGenreBookId() : Uuid {
		return($this->bookGenreBookId);
	}

	/**
	 * Mutator for the book genre book id
	 *
	 * @param Uuid/string $newBookGenreBookId new value of book genre book id
	 * @throws \RangeException if value is not positive
	 * @throws \TypeError if value is not Uuid
	 */
	public function setBookGenreBookId($newBookGenreBookId) : void {
		try {
			$uuid = self::validateUuid($newBookGenreBookId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//Converts and stores the book genre book id
		$this->bookGenreBookId = $uuid;
	}

	/**
	 * Accessor for the book genre genre id
	 *
	 * @return Uuid value of book genre genre id
	 */
	public function getBookGenreGenreId() : Uuid {
		return($this->bookGenreGenreId);
	}

	/**
	 * Mutator for the book genre genre id
	 *
	 * @param Uuid/string $newBookGenreGenreId new value of book genre genre id
	 * @throws \RangeException if value is not positive
	 * @throws \TypeError if value is not Uuid
	 */
	public function setBookGenreGenreId($newBookGenreGenreId) : void {
		try {
			$uuid = self::validateUuid($newBookGenreGenreId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//Converts and stores the book genre genre id
		$this->bookGenreGenreId = $uuid;
	}

}