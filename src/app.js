const $ = require('jquery');

$(document).ready(function() {

    // we get the template of an album's card
    // and we assign it to the variable albumHtml
    var albumHtml = $('#album-template').html();

    // we compile albumHtml in order to get the function albumTemplate
    // when called, this function returns an instance of albumHtml
    var albumTemplate = Handlebars.compile(albumHtml);

    if ($('#ajax-version').length) {
        // if we are dealing with the ajax version of our page,
        // we get all the genres
        getGenres();
        // and we get all the albums (in the order in which they appear in the file albums.php)
        getAlbums();
    }

    $("select.genres, select.year").change(function() {
        // when we select a genre or an order, first of all we empty the albums' container
        $(".albums").empty();

        // finally, we get the albums that match the selected genre and order
        getAlbums();
    });

    // ****************** functions ******************

    // this function makes an AJAX request, whose response (in case of success)
    // is an array of objects representing albums that match the genre and order selected
    // for each album in the array, the function "builds" a corresponding card, and appends it to the albums' container
    function getAlbums() {
        // we recover the genre and the order selected
        var selectedGenre = $("select.genres").val();
        var selectedOrder = $('select.year').val();

        // then, we make the ajax request (using the genre and the order selected as parameters)
        $.ajax({
            url: '../albums.php',
            method: 'GET',
            data: {
                genre: selectedGenre,
                order: selectedOrder
            },
            success: function(albums) {
                albums.forEach((album) => {
                    // for each album in the array albums we get
                    // the poster's url, the title, the author, the genre and the year
                    var placeholders = {
                        posterUrl: album.poster,
                        title: album.title,
                        author: album.author,
                        genre: album.genre,
                        year: album.year
                    };

                    // using this informations regarding the current album,
                    // we "build" a corresponding album's card
                    var albumHtml = albumTemplate(placeholders);

                    // then, we append the album's card to the albums' container
                    $(".albums").append(albumHtml);
                });
            },
            error: function() {
                console.log('Error');
            }
        });
    }

    // this function makes an AJAX request,
    // whose response (in case of success) is an array of strings representing the various albums' genres
    // for each genre in the array, the function "builds" a corresponding option, and appends it to the select with class "genres"
    function getGenres() {
        // we get the template of a genre's option
        // and we assign it to the variable genreHtml
        var genreHtml = $('#genre-template').html();

        // we compile genreHtml in order to get the function genreTemplate
        // when called, this function returns an instance of genreHtml
        var genreTemplate = Handlebars.compile(genreHtml);

        $.ajax({
            url: '../albums.php',
            method: 'GET',
            success: function(genres) {
                genres.forEach((genre) => {
                    // for each genre, we "build" a corresponding option
                    var genreHtml = genreTemplate({ genre });

                    // we append this option to the select having the class "genres"
                    $(".genres").append(genreHtml);
                });
            },
            error: function() {
                console.log("Error");
            }
        });
    }

});
