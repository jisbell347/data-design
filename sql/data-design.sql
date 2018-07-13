-- Sets the collation of the database to UTF-8.
ALTER DATABASE good_reads CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- Will drop the tables if currently existing.

DROP TABLE IF EXISTS bookgenres;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS genres;

-- Creates the Genres table.
CREATE TABLE genre (
	-- creates the attribute for the primary key
	-- NOT NULL means the attribute is required!
	genreId BINARY(16) NOT NULL,
	genreType VARCHAR (128) NOT NULL,
	-- creates a unique index to make sure duplicate data cannot exist
	UNIQUE(genreType),
	-- officiates the primary key of the Genres table
	PRIMARY KEY(genreId)

);

-- Creates the Books table.
CREATE TABLE book (
	-- creates the attribute for the primary key
	bookId BINARY(16) NOT NULL,
	-- creates the attribute for the
	bookGenreId BINARY(16) NOT NULL,
	bookAuthor VARCHAR (64),
	bookDescription VARCHAR (500),
	bookPages INT UNSIGNED,
	bookPublishDate YEAR(4),
	bookTitle VARCHAR (128),
)