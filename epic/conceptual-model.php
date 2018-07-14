<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Conceptual Model</title>
		<link rel="stylesheet" type="text/css" href="./css/styles.css" />
	</head>
	<body>
		<div>
			<h1>Conceptual Model</h1>
			<hr />
			<h3>Entities & Attributes</h3>
			<h4>Genre</h4>
			<ul>
				<li>genreId (Primary Key)</li>
				<li>genreType</li>
			</ul>
			<h4>Book</h4>
			<ul>
				<li>bookId (Primary Key)</li>
				<li>bookGenreId (Foreign Key)</li>
				<li>bookAuthor</li>
				<li>bookDescription</li>
				<li>bookPages</li>
				<li>bookPublishDate</li>
				<li>bookTitle</li>
			</ul>
			<h4>BookGenre</h4>
			<ul>
				<li>bookGenreId (Primary Key)</li>
				<li>bookGenreBookId (Foreign Key)</li>
				<li>bookGenreGenreId (Foreign Key)</li>
			</ul>
		</div>
		<div>
			<h3>Relationships</h3>
			<ul>
				<li>One genre contains many books (1-to-n)</li>
				<li>Many books belong to multiple genres (m-to-n)</li>
			</ul>
		</div>
		<div>
			<h1>ERD</h1>
			<img src="erd-diagram.svg" alt="Picture of ERD Diagram"/>
		</div>
		<div>
			<button class="btn">
				<a href="./index.php">Back to Home</a>
			</button>
		</div>
	</body>

</html>