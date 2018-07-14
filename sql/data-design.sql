-- Sets the collation of the database to UTF-8.
ALTER DATABASE jisbell1 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- Will drop the tables if currently existing.

DROP TABLE IF EXISTS bookgenres;
DROP TABLE IF EXISTS book;
DROP TABLE IF EXISTS genre;

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

-- Creates the Book table.
CREATE TABLE book (
	-- creates the attribute for the primary key
	bookId BINARY(16) NOT NULL,
	-- creates the attributes for the foreign key.
	bookGenreId BINARY(16) NOT NULL,
	bookAuthor VARCHAR (64) NOT NULL,
	bookDescription VARCHAR (500),
	bookPages INT UNSIGNED,
	bookPublishDate YEAR(4),
	bookTitle VARCHAR (128) NOT NULL,
	-- creates the index for the foreign key.
	INDEX(bookGenreId),
	-- creates the foreign key relation.
	FOREIGN KEY(bookGenreId) REFERENCES genre(genreId),
	-- officiates the primary key of the Book table
	PRIMARY KEY(bookId)
);

-- creates the Bookgenres table.
CREATE TABLE bookgenres (
	-- creates the attribute for the primary key
	bookgenresId BINARY(16) NOT NULL,
	-- creates the foreign key attribute.
	bookgenresBookId BINARY(16) NOT NULL,
	bookgenresGenreId BINARY(16) NOT NULL,
	-- creates the indexes for the foreign keys.
	INDEX(bookgenresBookId),
	INDEX(bookgenresGenreId),
	-- creates the foreign key.
	FOREIGN KEY(bookgenresBookId) REFERENCES book(bookId),
	FOREIGN KEY(bookgenresGenreId) REFERENCES genre(genreId),
	-- creates the primary key.
	PRIMARY KEY (bookgenresId)
);