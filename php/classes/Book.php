<?php
/**
 * Small Cross Section of the Goodreads site book section within a genre.
 *
 * This is a small example of what sites like Goodreads displays when a user clicks on a genre of choice and a list of
 books are displayed within that genre. The user then clicks on a specific book which brings them to that book's page.
 * This can easily be extended to emulate more features of Goodreads.
 *
 * @author Joseph Isbell <jisbell1@cnm.edu>
 * @version 1.0.0
 **/

class Book {

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
	 */
	private $bookAuthor;

	/**
	 * A brief description of this Book
	 * @var string $bookDescription
	 */
	private $bookDescription;

	/**
	 * The number of pages this Book
	 * @var int unsigned $bookPages
	 */
	private $bookPages;

	/**
	 * The year this Book was published
	 * @var int $bookPublishDate
	 */
	private $bookPublishDate;

	/**
	 * The title of this Book
	 * @var string $bookTitle
	 */
	private $bookTitle;

	/**
	 * The accessor method for book id
	 *
	 * @return Uuid value of book id
	 */
	public function getBookId() : Uuid { //requires an Uuid is returned
		return($this->bookId);
	}
	/**
	 *The mutator method for the book id
	 *
	 * @params Uuid/string $newBookId new value of book id
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
	 */
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
	/**
	 * @return string
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
	/**
	 * @param string $bookAuthor
	 */
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
	 */
	/**
	 * @return string
	 */
	public function getBookDescription(): string {
		return($this->bookDescription);
	}

	/**
	 * Mutator method for book description
	 *
	 * @param string $newBookDescription new value for book description
	 * @throws \RangeException if $newBookDescription is > 500 characters
	 * @throws \TypeError if $newBookDescription is not a string
	 */
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
		//Verifies that the publish date is greater than zero. Throws error message if it is
		if($newBookPublishDate <= 0) {
			throw(new \InvalidArgumentException("The year entered is invalid"));
		}
		//Throws error message if date is greater than four characters
		if($newBookPublishDate > 4) {
			throw (new \RangeException("The year cannot exceed four digits"));
		}
		//Stores the value if passes validation
		$this->bookPublishDate = $newBookPublishDate;
	}

	/**
	 * Accessor method for book title
	 *
	 * @return string value for book title
	 */
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
	 */
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
}