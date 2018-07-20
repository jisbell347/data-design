<?php
namespace Edu\Cnm\DataDesign;

require_once ("autoload.php");
require_once (dirname(__DIR__, 2 ) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Small Cross Section of the Goodreads site book section within a genre.
 *
 * This is a small example of what sites like Goodreads displays when a user clicks on a genre of choice and a list of
 * books are displayed within that genre. The user then clicks on a specific book which brings them to that book's page.
 * This can easily be extended to emulate more features of Goodreads.
 *
 * @author Joseph Isbell <jisbell1@cnm.edu>
 * @version 1.0.0
 **/

class Book {
	use ValidateUuid;
	/**
	 *id for this Book; this is the primary key
	 * @var Uuid $bookId
	 *
	 **/
	private $bookId;

	/**
	 * id of the Genre that the Book belongs to. This is a foreign key
	 * @var Uuid $bookGenreId
	 **/
	private $bookGenreId;

	/**
	 * The name of the author of this Book
	 * @var string $bookAuthor
	 **/
	private $bookAuthor;

	/**
	 * A brief description of this Book
	 * @var string $bookDescription
	 **/
	private $bookDescription;

	/**
	 * The number of pages this Book
	 * @var int unsigned $bookPages
	 **/
	private $bookPages;

	/**
	 * The year this Book was published
	 * @var int $bookPublishDate
	 **/
	private $bookPublishDate;

	/**
	 * The title of this Book
	 * @var string $bookTitle
	 **/
	private $bookTitle;
	/**
	 * Constructor for the Book Class
	 *
	 * @param Uuid|string $newBookId id of this book or null if a new book
	 * @param Uuid|string $newBookGenreId id of the genre the book is in
	 * @param string $newBookAuthor value of the book's author
	 * @param string $newBookDescription description of the book
	 * @param int $newBookPages number of pages in the book
	 * @param int $newBookPublishDate the date the book was published
	 * @param string $newBookTitle the book's title
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if values exceed the preset bounds (e.g.; the strings have too many characters)
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data violates the type hints
	 * @Documentation https:/php.net/manuel/en/languqge.oop5.decon.php
	 */
	public  function __construct($newBookId, $newBookGenreId, string $newBookAuthor, string $newBookDescription, int $newBookPages, int $newBookPublishDate, string $newBookTitle) {
		try {
			$this->setBookId($newBookId);
			$this->setBookGenreId($newBookGenreId);
			$this->setBookAuthor($newBookAuthor);
			$this->setBookDescription($newBookDescription);
			$this->setBookPages($newBookPages);
			$this->setBookPublishDate($newBookPublishDate);
			$this->setBookTitle($newBookTitle);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * The accessor method for book id
	 *
	 * @return Uuid value of book id
	 **/
	public function getBookId() : Uuid { //requires an Uuid is returned
		return($this->bookId);
	}
	/**
	 *The mutator method for the book id
	 *
	 * @param Uuid/string $newBookId new value of book id
	 * @throws \RangeException if $newBookId is not positive
	 * @throws \TypeError if $newBookId is not an Uuid
	 **/
	public function setBookId($newBookId) : void { //Does not expect a return
		try {
			//Checks to see if the Uuid is valid
			$uuid = self::validateUuid($newBookId);
			//Catches the exception if not valid and throws error based on exception caught
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//Convert and store the book id if passes validation
		$this->bookId = $uuid;
	}

	/**
	 * accessor method for book genre id
	 *
	 * @return Uuid value of book genre id
	 **/
	public function getBookGenreId() : Uuid {
		return($this->bookGenreId);
	}
	/**
	 * the mutator method for the book genre id
	 *
	 * @param Uuid/string $newBookGenreId the new value of book genre id
	 * @throws \RangeException if $newBookGenreId is not positive
	 * @throws \TypeError if $newBookId is not an Uuid
	 */
	public function setBookGenreId($newBookGenreId) : void { //Does not expect a return
		try {
			//Checks to see if the Uuid is valid
			$uuid = self::validateUuid($newBookGenreId);
			//Catches the exception if not valid and throws error based on exception caught
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//Convert and store the book id if passes validation
		$this->bookGenreId = $uuid;
	}

	/**
	 * The accessor method for the book author
	 *
	 * @return string value of book author
	 */
	public function getBookAuthor(): string { //requires a string be returned
		return($this->bookAuthor);
	}

	/**
	 * Mutator method for book author
	 *
	 * @param string $newBookAuthor new value of book author
	 * @throws \InvalidArgumentException if $newBookAuthor is an empty string or insecure
	 * @throws \RangeException if $newBookAuthor is > 64 characters
	 * @throws \TypeError if $newBookAuthor is not a string
	 **/
	public function setBookAuthor(string $newBookAuthor): void {
		//verify the book author value is secure, trims white space and removes malicious html tags
		$newBookAuthor = trim($newBookAuthor);
		$newBookAuthor = filter_var($newBookAuthor, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		//Checks to see if value is empty and throws an error if so
		if(empty($newBookAuthor) === true) {
			throw(new \InvalidArgumentException("Author name cannot be left blank."));
		}
		//verify the author name does not exceed character limit
		if(strlen($newBookAuthor) > 64) {
			throw(new \RangeException('Author name is too long'));
		}
		//Store the value once it passes validation
		$this->bookAuthor = $newBookAuthor;
	}

	/**
	 * Accessor method for the book description
	 *
	 * @return string value of book description
	 **/
	public function getBookDescription(): string {
		return($this->bookDescription);
	}

	/**
	 * Mutator method for book description
	 *
	 * @param string $newBookDescription new value for book description
	 * @throws \RangeException if $newBookDescription is > 500 characters
	 * @throws \TypeError if $newBookDescription is not a string
	 **/
	//Only allows a string type value to pass into the function
	public function setBookDescription(string $newBookDescription) : void { //Does not expect a return
		//verify the description content is secure, trim the whitespace and remove any malicious html tags
		$newBookDescription = trim($newBookDescription);
		$newBookDescription = filter_var($newBookDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		//Checks to see if the value exceeds 500 characters and throws an error if so
		if(strlen($newBookDescription) > 500) {
			throw (new \RangeException("Character limit exceeded"));
		}
		$this->bookDescription = $newBookDescription;
	}

	/**
	 * Accessor method for book pages
	 *
	 * @return int value of book pages
	 **/
	public function getBookPages() : int { //Requires an integer be returned
		return($this->bookPages);
	}

	/**
	 * Mutator method for book pages
	 *
	 * @param int $newBookPages new value for book pages
	 * @throws \InvalidArgumentException if pages is not a positive number or zero
	 * @throws \RangeException if book pages is greater than the set character limit
	 * @throws \TypeError if book pages is not a integer
	 **/
	public function setBookPages(int $newBookPages) : void {
		//Verifies that the number of pages is greater than zero
		if($newBookPages <= 0) {
			throw(new \InvalidArgumentException("Number of pages must be greater than zero"));
		}
		//Stores the value if passes validation
		$this->bookPages = $newBookPages;
	}

	/**
	 * Accessor method for book publish date
	 *
	 * @return int value of book publish date
	 **/
	public function getBookPublishDate() : int { //Requires an integer be returned
		return($this->bookPublishDate);
	}

	/**
	 * Mutator method for book publish date
	 *
	 * @param int $newBookPublishDate new value for book publish date
	 * @throws \InvalidArgumentException if publish date is not a positive number or zero
	 * @throws \RangeException if book publish date is greater than 4 characters
	 * @throws \TypeError if book publish date is not a integer
	 **/
	public function setBookPublishDate(int $newBookPublishDate) : void {
		//Throws error message if date is greater than four characters
		if($newBookPublishDate < 1400 || $newBookPublishDate > 2025 ) {
			throw (new \RangeException("The year cannot exceed four digits"));
		}
		//Stores the value if passes validation
		$this->bookPublishDate = $newBookPublishDate;
	}

	/**
	 * Accessor method for book title
	 *
	 * @return string value for book title
	 **/
	public function getBookTitle() : string {
		return($this->bookTitle);
	}

	/**
	 * Mutator method for book title
	 *
	 * @param string $newBookTitle new value for book title
	 * @throws \InvalidArgumentException if value is empty or insecure
	 * @throws \RangeException if value exceeds character limit
	 * @throws \TypeError if not a string
	 **/
	public function setBookTitle(string $newBookTitle): void {
		//Verifies value is not empty and secure, trims whitespace and removes malicious html tags
		$newBookTitle = trim($newBookTitle);
		$newBookTitle = filter_var($newBookTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		//If book title is an empty string, throws an error message
		if(empty($newBookTitle) === true) {
			throw(new \InvalidArgumentException("Book title cannot be empty"));
		}
		//If character length of title exceeds 128 characters, throws an error message
		if(strlen($newBookTitle) > 128) {
			throw(new \RangeException("The book title has exceed the character limit"));
		}
		//Stores value if validation passes
		$this->bookTitle = $newBookTitle;
	}

	/**
	 * inserts this Book into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {
		// create query template
		$query = "INSERT INTO book(bookId, bookGenreId, bookAuthor, bookDescription, bookPages, bookPublishDate, bookTitle) VALUES (:bookId, :bookGenreIdm :bookAuthorm :bookDescription, :bookPages, :bookPublishDate, :bookTitle)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["bookId" => $this->bookId->getBytes(), "bookGenreId" => $this->bookGenreId->getBytes(), "bookAuthor" => $this->bookAuthor, "bookDescription" => $this->bookDescription, "bookPages" => $this->bookPages, "bookPublishDate" => $this->bookPublishDate, "bookTitle" => $this->bookTitle];
		$statement->execute($parameters);
	}
	/**
	 * deletes this book from mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {
		//creates the query template
		$query = "DELETE FROM book WHERE bookId = :bookId";
		$statement = $pdo->prepare($query);

		//bind the member variable to the place holder in the template
		$parameters = ["bookId" => $this->bookId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * Updates the book in mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {
		//create query template
		$query = "UPDATE book SET bookGenreId = :bookGenreId, bookAuthor = :bookAuthor, bookDescription = :bookDescription, bookPages = :bookPages, bookPublishDate = :bookPublishDate, bookTitle = :bookTitle WHERE bookId = :bookId";
		$statement = $pdo->prepare($query);

		//binds the members to the template
		$parameters = ["bookId" => $this->bookId->getBytes(), "bookGenreId" => $this->bookGenreId->getBytes(), "bookAuthor" => $this->bookAuthor, "bookDescription" => $this->bookDescription, "bookPages" => $this->bookPages, "bookPublishDate" => $this->bookPublishDate, "bookTitle" => $this->bookTitle];
		$statement->execute($parameters);
	}

	/**
	 *gets the Book by bookId
	 *
	 *@param \PDO $pdo PDO connection object
	 *@param Uuid|string $bookId book id to search for
	 *@return Book|null Book found or null if not found
	 *@throws \PDOException when mySQL related errors occur
	 *@throws \TypeError if $pdo is not a PDO connection object
	 **/
	public static function getBookByBookId(\PDO $pdo, $bookId) : ?Book {
		// sanitize the bookId before searching
		try {
			$bookId = self::validateUuid($bookId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create the query template
		$query = "SELECT bookId, bookGenreId, bookAuthor, bookDescription, bookPages, bookPublishDate, bookTitle FROM book WHERE bookId = :bookId";
		$statement = $pdo->prepare($query);

		// bind the book id to the place holder in the template
		$parameters = ["bookId" => $bookId->getBytes()];
		$statement->execute($parameters);

		//grab the book from mySQL
		try{
			$book = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$book = new Book($row["bookId"], $row["bookGenreId"], $row["bookAuthor"], $row["bookDescription"], $row["bookPages"], $row["bookPublishDate"], $row["bookTitle"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($book);
	}
	/**
	 * gets the Book by genre id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $bookGenreId genre id to search by
	 * @return \SplFixedArray SplFixedArray of books found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public static function getBookByBookGenreId(\PDO $pdo, $bookGenreId) : \SplFixedArray {
		try {
			$bookGenreId = self::validateUuid($bookGenreId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT bookId, bookGenreId, bookAuthor, bookDescription, bookPages, bookPublishDate, bookTitle FROM book WHERE bookGenreId = :bookGenreId";
		$statement = $pdo->prepare($query);

		//bind the book genre id to the placeholders in the template
		$parameters = ["bookGenreId" => $bookGenreId->getBytes()];
		$statement->execute($parameters);

		//build an array of books
		$books = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$book = new Book($row["bookId"], $row["bookGenreId"], $row["bookAuthor"], $row["bookDescription"], $row["bookPages"], $row["bookPublishDate"], $row["bookTitle"]);
				$books[$books->key()] = $book;
				$books->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0 , $exception));
			}
		}
		return($books);
	}
	/**
	 * gets the book by author
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $bookAuthor book author to search for
	 * @return \SplFixedArray SplFixedArray of authors found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBookByBookAuthor(\PDO $pdo, string $bookAuthor) : \SplFixedArray {
		//sanitize the author before searching for it
		$bookAuthor = trim($bookAuthor);
		$bookAuthor = filter_var($bookAuthor, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($bookAuthor) === true) {
			throw(new \PDOException("Book author is invalid"));
		}

		//escape any mySQL wild cards
		$bookAuthor = str_replace("_", "\\", str_replace("%", "\\%", $bookAuthor));

		//create query template
		$query = "SELECT bookId, bookGenreId, bookAuthor, bookDescription, bookPages, bookPublishDate, bookTitle FROM book WHERE bookAuthor LIKE :bookAuthor";
		$statement = $pdo->prepare($query);

		//bind the book author to the place holder in the template
		$bookAuthor = "%$bookAuthor%";
		$parameters = ["bookAuthor" => $bookAuthor];
		$statement->execute($parameters);

		//build an array of authors
		$books = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$book = new Book($row["bookId"], $row["bookGenreId"], $row["bookAuthor"], $row["bookDescription"], $row["bookPages"], $row["bookPublishDate"], $row["bookTitle"]);
				$books[$books->key()] = $book;
				$books->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw (new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($books);
	}
	/**
	 * gets the book by title
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $bookTitle book title to search for
	 * @return \SplFixedArray SplFixedArray of titles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBookByBookTitle(\PDO $pdo, $bookTitle) : \SplFixedArray {
		// sanitize the title before searching for it
		$bookTitle = trim($bookTitle);
		$bookTitle = filter_var($bookTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($bookTitler) === true) {
			throw(new \PDOException("Book title is invalid"));
		}

		//escape any mySQL wild cards
		$bookTitle = str_replace("_", "\\", str_replace("%", "\\%", $bookTitle));

		//create query template
		$query = "SELECT bookId, bookGenreId, bookAuthor, bookDescription, bookPages, bookPublishDate, bookTitle FROM book WHERE bookTitle LIKE :bookTitle";
		$statement = $pdo->prepare($query);

		// Bind the book title to the place holder in the template
		$bookTitle = "%$bookTitle%";
		$parameters = ["bookTitle" => $bookTitle];
		$statement->execute($parameters);

		// build an array of book titles
		$books = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\POD::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$book = new Book($row["bookId"], $row["bookGenreId"], $row["bookAuthor"], $row["bookDescription"], $row["bookPages"], $row["bookPublishDate"], $row["bookTitle"]);
				$books[$books->key()] = $book;
				$books->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($books);
	}
/**
 * gets all Books
 *
 * @param \PDO $pdo PDO connection object
 * @return \SplFixedArray of Books found or null if not found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/
public static function getAllBooks(\PDO $pdo) : \SplFixedArray {
	//create query template
	$query = "SELECT bookId, bookGenreId, bookAuthor, bookDescription, bookPages, bookPublishDate, bookTitle FROM book";
	$statement = $pdo->prepare($query);
	$statement->execute();

	//build an array of books
	$books = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\POD::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$book = new Book($row["bookId"], $row["bookGenreId"], $row["bookAuthor"], $row["bookDescription"], $row["bookPages"], $row["bookPublishDate"], $row["bookTitle"]);
			$books[$books->key()] = $book;
			$books->next();
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($books);
	}

}