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
		$newBookAuthor = filter_var(FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
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
}