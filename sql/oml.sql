 -- INSERT Statements

INSERT INTO genre(genreId, genreType) VALUES (UNHEX("0225722944b54d56be0929d0fd82dc03"), "Romance");

UPDATE genre SET genreType = "Sci-Fi" WHERE genreId = UNHEX("8c38a40ddec34a469b8708f059ae6df6");

 SELECT *
 FROM genre;

DELETE FROM genre WHERE genreId = UNHEX("8c38a40ddec34a469b8708f059ae6df6");

 INSERT INTO book(bookId, bookGenreId, bookAuthor, bookDescription, bookPages, bookPublishDate, bookTitle) VALUES (UNHEX("c6b33f751c9e413a90b8ae9f077756e3"), unhex("0225722944b54d56be0929d0fd82dc03"), "Shawn Spencer", "Shawn details his amazing gift in this best selling book", 582, 2015, "Pysch");