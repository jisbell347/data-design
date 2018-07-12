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
			<h4>Profile</h4>
			<ul>
				<li>profileId (Primary Key)</li>
				<li>profileEmail</li>
				<li>profileName</li>
				<li>profileHash (password authentication)</li>
			</ul>
			<h4>Genre</h4>
			<ul>
				<li>genreId (Primary Key)</li>
				<li>genreProfileId (Foreign Key)</li>
				<li>genreType</li>
			</ul>
			<h4>Book</h4>
			<ul>
				<li>bookId (Primary Key)</li>
				<li>bookGenreId (Foreign Key)</li>
				<li>bookProfileId (Foreign Key)</li>
				<li>bookTitle</li>
				<li>bookAuthor</li>
				<li>bookPublishDate</li>
				<li>bookPages</li>
			</ul>
			<h4>Rates</h4>
			<ul>
				<li>ratesBookId (Foreign Key)</li>
				<li>ratesNumber</li>
				<li>ratesDetails</li>
				<li>ratesAverage</li>
			</ul>
		</div>
		<div>
			<h3>Relationships</h3>
			<ul>
				<li>One genre contains many books (1-to-n)</li>
				<li>Many books belong to multiple genres (m-to-n)</li>
				<li>One user is able to rate many books (1-to-n)</li>
				<li>Many users are able to rate multiple books(m-to-n)</li>
			</ul>
		</div>
		<div>
			<button class="btn">
				<a href="./index.php">Back to Home</a>
			</button>
		</div>
	</body>

</html>