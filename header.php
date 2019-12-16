<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styles/style.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Instructions</a></li>
                <li><a href="https://github.com/eddiefiggie/PHP-MarvelAPI-Client">Github</a></li>
                <li><a href="https://www.marvel.com/">Marvel</a></li>
            </ul>
        </nav>
        <div class="header-search">
            <form action="search-result.php" method="get">
                <input type="text" name="generalSearch" placeholder="marvel search field" />
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </header>