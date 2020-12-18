<?php

    $albums = [
        [
            'poster' => 'https://www.onstageweb.com/wp-content/uploads/2018/09/bon-jovi-new-jersey.jpg',
            'title' => 'New Jersey',
            'author' => 'Bon Jovi',
            'genre' => 'Rock',
            'year' => '1988'
        ],
        [
            'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51NrqJ85VXL._AC_SX425_.jpg',
            'title' => 'Live at Wembley 86',
            'author' => 'Queen',
            'genre' => 'Pop',
            'year' => '1992'
        ],
        [
            'poster' => 'https://images-na.ssl-images-amazon.com/images/I/41JD3CW65HL.jpg',
            'title' => 'Ten\'s Summoner\'s Tales',
            'author' => 'Sting',
            'genre' => 'Pop',
            'year' => '1993'
        ],
        [
            'poster' => 'https://cdn2.jazztimes.com/2018/05/SteveGadd-800x723.jpg',
            'title' => 'Steve Gadd Band',
            'author' => 'Steve Gadd Band',
            'genre' => 'Jazz',
            'year' => '2018'
        ],
        [
            'poster' => 'https://images-na.ssl-images-amazon.com/images/I/810nSIQOLiL._SY355_.jpg',
            'title' => 'Brave new World',
            'author' => 'Iron Maiden',
            'genre' => 'Metal',
            'year' => '2000'
        ],
        [
            'poster' => 'https://upload.wikimedia.org/wikipedia/en/9/97/Eric_Clapton_OMCOMR.jpg',
            'title' => 'One more car, one more raider',
            'author' => 'Eric Clapton',
            'genre' => 'Rock',
            'year' => '2002'
        ],
        [
            'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51rggtPgmRL.jpg',
            'title' => 'Made in Japan',
            'author' => 'Deep Purple',
            'genre' => 'Rock',
            'year' => '1972'
        ],
        [
            'poster' => 'https://images-na.ssl-images-amazon.com/images/I/81r3FVfNG3L._SY355_.jpg',
            'title' => 'And Justice for All',
            'author' => 'Metallica',
            'genre' => 'Metal',
            'year' => '1988'
        ],
        [
            'poster' => 'https://img.discogs.com/KOBsqQwKiNKH-q927oHMyVdDzSo=/fit-in/596x596/filters:strip_icc():format(jpeg):mode_rgb():quality(90)/discogs-images/R-6406665-1418464475-6120.jpeg.jpg',
            'title' => 'Hard Wired',
            'author' => 'Dave Weckl',
            'genre' => 'Jazz',
            'year' => '1994'
        ],
        [
            'poster' => 'https://m.media-amazon.com/images/I/71K9CbNZPsL._SS500_.jpg',
            'title' => 'Bad',
            'author' => 'Michael Jackson',
            'genre' => 'Pop',
            'year' => '1987'
        ]
    ];

    // we check if an ajax request with parameter "genre" has been made
    if (ajax_request_detected() && isset($_GET['genre'])) {
        // if an ajax request with parameter "genre" has been made
        // we get the selected genre
        $selected_genre = $_GET['genre'];

        // we save the array of albums in the variable $albums_filtered
        $albums_filtered = $albums;

        if ($selected_genre != 'All') {
            // if the user has selected a specific genre (i.e. if $selected_genre is different from "All"),
            // then we filter the array saved in $albums_filtered according the selected genre
            $albums_filtered = array_filter($albums_filtered, function($album) {
                global $selected_genre;
                return $album["genre"] == $selected_genre;
            });
            $albums_filtered = array_values($albums_filtered);
        }

        // finally, we get the json representation of $albums_filtered
        header('Content-Type: application/json');
        echo json_encode($albums_filtered);

    } else {
        // if the ajax request that has been made does not include the parameter "genre"
        // (or if no ajax requests have been made at all)
        // we create a variable $genres
        $genres = [];

        // we iterate over the array of albums
        foreach ($albums as $album) {
            // for each album in the array, we check if its genre has already been pushed in the array $genres
            if (!in_array($album["genre"], $genres)) {
                // if the current album's genre is not already included in the array $genres,
                // then we push it in this array
                $genres[] = $album["genre"];
            }
        }

        if (ajax_request_detected()){
            // finally, if an ajax request has been detected, we get the json representation of $genres
            header('Content-Type: application/json');
            echo json_encode($genres);
        }
    }


    // ****************** functions ******************

    // this function checks whether an ajax request has been made
    function ajax_request_detected() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

?>
