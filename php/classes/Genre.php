<?php
namespace Edu\Cnm\DataDesign;

require_once ('autoload.php');
require_once (dirname(__DIR__, 2) . "/vendor/autoload.php");

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

	/**
	 * Inserts this Genre into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {
		//create query template
		$query = "INSERT INTO genre(genreId, genreType) VALUES( :genreId, :genreType)";
		$statement = $pdo->prepare($query);
		//bind the member variables to the place holders in the template
		$parameters = ["genreId"=>$this->genreId->getBytes(), "genreType"=>$this->genreType];
		$statement->execute($parameters);
	}

	/**
	 * deletes this genre from mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {
		//creates the query template
		$query = "DELETE FROM genre WHERE genreId = :genreId";
		$statement = $pdo->prepare($query);

		//bind the member variable to the place holder in the template
		$parameters = ["genreId" => $this->genreId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * Updates the genre in mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) : void {
		//create query template
		$query = "UPDATE genre SET genreType = :genreType WHERE genreId = :genreId";
		$statement = $pdo->prepare($query);

		//binds the members to the template
		$parameters = ["genreId" => $this->genreId->getBytes(), "genreType" => $this->genreType];
		$statement->execute($parameters);
	}

	/**
	 * Gets the genre by genre id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $genreId genre id to search for
	 * @return Genre|null genre found or not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getGenreByGenreId(\PDO $pdo, $genreId) : ?Genre {
		//sanitize the genreId before searching
		try {
			$genreId = self::validateUuid($genreId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create the query template
		$query = "SELECT genreId, genreType FROM genre WHERE genreId = :genreId";
		$statement= $pdo->prepare($query);

		// bind the genre id to the place holder in the template
		$parameters = ["genreId" => $genreId->getBytes()];
		$statement->execute($parameters);

		//grab the genre from mySQL
		try {
			$genre = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$genre = new Genre($row["genreId"], $row["genreType"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($genre);
	}
	/**
	 * Gets the genre by type
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $genreType genre type to search for
	 * @return \SplFixedArray SplFixedArray of genres found
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getGenreByGenreType(\POO $pdo, string $genreType) : \SplFixedArray {
		//sanitize the type before searching
		$genreType = trim($genreType);
		$genreType = filter_var($genreType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($genreType) === true) {
			throw(new \PDOException("Genre type cannot be empty"));
		}

		//escape any mySQL wild cards
		$genreType = str_replace("_", "\\_", str_replace("&", "\\&", $genreType));

		//create query template
		$query = "SELECT genreId, genreType FROM genre WHERE genreType LIKE :genreType";
		$statement = $pdo->prepare($query);

		// bind the members to the template place holder
		$genreType = "%$genreType%";
		$parameters = ["genreType" => $genreType];
		$statement->execute($parameters);

		//build an array of genres
		$genres = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$genre = new Genre($row["genreId"], $row["genreType"]);
				$genres[$genres->key()] = $genre;
				$genres->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($genres);
	}
	/** Gets all genres
	*
	* @param \PDO $pdo PDO connection object
	* @return \SplFixedArray SplFixedArray of genres found
	* @throws \PDOException when mySQL errors occur
	* @throws \TypeError when variables are not the correct data type
	**/
	public static function getAllTweets(\PDO $pdo) : \SplFixedArray {
	// create query template
		$query = "SELECT genreId, genreType FROM genre";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of genres
		$genres = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$genre = new Genre($row["genreId"], $row["genreType"]);
				$genres[$genre->key()] = $genre;
				$genres->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0 , $exception));
			}
		}
		return($genres);
	}

}
