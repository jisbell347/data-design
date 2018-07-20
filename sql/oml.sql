 -- INSERT Statements

INSERT INTO genre(genreId, genreType) VALUES (UNHEX("ea579028c78144c9a4ff13d8967f929d"), "Manga");

UPDATE genre SET genreType = "Comic" WHERE genreId = UNHEX("ea579028c78144c9a4ff13d8967f929d");

INSERT INTO book(bookId, bookGenreId, bookAuthor, bookDescription, bookPages, bookPublishDate, bookTitle) VALUES (UNHEX("c6b33f751c9e413a90b8ae9f077756e3"), unhex("ea579028c78144c9a4ff13d8967f929d"), "Shawn Spencer", "Shawn details his amazing gift in this best selling book", 582, 2015, "Pysch");

UPDATE book SET bookPublishDate = 2018 WHERE bookId = UNHEX("c6b33f751c9e413a90b8ae9f077756e3");

INSERT INTO bookGenre(bookgenreId, bookgenreBookId, bookgenreGenreId) VALUES (UNHEX("ed7e623dea144cc09cd8152f39daa948"), unhex("ea579028c78144c9a4ff13d8967f929d"), UNHEX("c6b33f751c9e413a90b8ae9f077756e3"));

UPDATE bookGenre SET bookgenreGenreId = UNHEX("8c38a40ddec34a469b8708f059ae6df6");

 SELECT *
 FROM genre, book, bookGenre;

 DELETE FROM bookGenre WHERE bookgenreId = UNHEX("ed7e623dea144cc09cd8152f39daa948");

 DELETE FROM book WHERE bookId = UNHEX("c6b33f751c9e413a90b8ae9f077756e3");

 DELETE FROM genre WHERE genreId = UNHEX("8c38a40ddec34a469b8708f059ae6df6");






