<?php
namespace Edu\Cnm\DataDesign;

require_once ("autoload.php");
require_once (dirname(__DIR__, 2 ) . "/classes/autoload.php");

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
	/**
	 * inserts this BookGenre into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {
		//create query template
		$query = "INSERT INTO bookGenre(bookgenreId, bookgenreBookId, bookgenreGenreId) VALUES(:bookgenreId, :bookgenreBookId, :bookgenreGenreId)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["bookGenreId" => $this->bookGenreId->getBytes(), "bookGenreBookId" => $this->bookGenreBookId->getBytes(), "bookGenreGenreId" => $this->bookGenreGenreId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * deletes the BookGenre from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {
		// create query template
		$query = "DELETE FROM bookGenre WHERE bookgenreId = :bookgenreId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["bookGenreId" => $this->bookGenreId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this BookGenre in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {
		// create query template
		$query = "UPDATE bookGenre SET bookgenreBookId = :bookgenreBookId, bookgenreGenreId = :bookgenreGenreId WHERE bookgenreId = :bookgenreId";
		$statement = $pdo->prepare($query);

		//binds variables to the place holders in the template
		$parameters = ["bookGenreId" => $this->bookGenreId->getBytes(), "bookGenreBookId" => $this->bookGenreBookId->getBytes(), "bookGenreGenreId" => $this->bookGenreGenreId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * gets the BookGenre by bookGenreId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $bookGenreId book genre id to search for
	 * @return BookGenre|null BookGenre found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public static function getBookGenreByBookGenreId(\PDO $pdo, $bookGenreId) : ?BookGenre {
		//sanitize the string before searching
		try {
			$bookGenreId = self::validateUuid($bookGenreId);
		} catch(\InvalidArgumentException | \RangeException |\Exception |\TypeError $exception) {
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT bookGenreId, bookGenreBookId, bookGenreGenreId FROM bookGenre WHERE bookgenreId = : bookgenreId";
		$statement = $pdo->prepare($query);

		//bind the bookgenre id to the place holder in the template
		$parameters = ["bookGenreId" => $bookGenreId->getBytes()];
		$statement->execute($parameters);

		// grab the bookGenre from mySQL
		try {
			$bookGenre = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$bookGenre = new BookGenre($row["bookGenreId"], $row["bookGenreBookId"], $row["bookGenreGenreId"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($bookGenre);
	}
	/**
	 * gets the BookGenre by bookGenreBookId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $bookGenreBookId book genre book id to search for
	 * @return \SplFixedArray SPLFixedArray of books in book genre found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public static function getBookGenreByBookGenreBookId(\PDO $pdo, $bookGenreBookId) : \SplFixedArray {
		//sanitize the string before searching
		try {
			$bookGenreBookId = self::validateUuid($bookGenreBookId);
		} catch(\InvalidArgumentException | \RangeException |\Exception |\TypeError $exception) {
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT bookGenreId, bookGenreBookId, bookGenreGenreId FROM bookGenre WHERE bookgenreBookId = : bookgenreBookId";
		$statement = $pdo->prepare($query);

		//bind the bookgenre id to the place holder in the template
		$parameters = ["bookGenreBookId" => $bookGenreBookId->getBytes()];
		$statement->execute($parameters);

		//build array of books
		$bookGenres = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$bookGenre = new BookGenre($row["bookGenreId"], $row["bookGenreBookId"], $row["bookGenreGenreId"]);
				$bookGenres[$bookGenres->key()] = $bookGenre;
				$bookGenres->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($bookGenres);
	}
	/**
	 * gets the BookGenre by bookGenreGenreId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $bookGenreGenreId book genre genre id to search for
	 * @return \SplFixedArray SPLFixedArray of books in book genre found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public static function getBookGenreByBookGenreGenreId(\PDO $pdo, $bookGenreGenreId) : \SplFixedArray {
		//sanitize the string before searching
		try {
			$bookGenreGenreId = self::validateUuid($bookGenreGenreId);
		} catch(\InvalidArgumentException | \RangeException |\Exception |\TypeError $exception) {
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT bookGenreId, bookGenreBookId, bookGenreGenreId FROM bookGenre WHERE bookgenreGenreId = :bookgenreGenreId";
		$statement = $pdo->prepare($query);

		//bind the bookgenre id to the place holder in the template
		$parameters = ["bookGenreGenreId" => $bookGenreGenreId->getBytes()];
		$statement->execute($parameters);

		//build array of genres
		$bookGenres = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$bookGenre = new BookGenre($row["bookGenreId"], $row["bookGenreBookId"], $row["bookGenreGenreId"]);
				$bookGenres[$bookGenres->key()] = $bookGenre;
				$bookGenres->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($bookGenres);
	}
	/**
	 * gets all book genres
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SPLFixedArray of books in book genre found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public static function getAllBookGenres(\PDO $pdo) : \SplFixedArray {
		//create query template
		$query = "SELECT bookGenreId, bookGenreBookId, bookGenreGenreId FROM bookGenre";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build array of genres
		$bookGenres = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$bookGenre = new BookGenre($row["bookGenreId"], $row["bookGenreBookId"], $row["bookGenreGenreId"]);
				$bookGenres[$bookGenres->key()] = $bookGenre;
				$bookGenres->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($bookGenres);
	}
}