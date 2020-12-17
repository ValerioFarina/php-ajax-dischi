const $ = require('jquery');

$(document).ready(function() {
    var albumHtml = $('#album-template').html();

    var albumTemplate = Handlebars.compile(albumHtml);

    getAlbums('All');

    $("select.genres").change(function() {
        $(".albums").empty();

        var selectedGenre = $("select.genres").val();

        getAlbums(selectedGenre);
    });

    // ****************** functions ******************
    function getAlbums(genre) {
        $.ajax({
            url: 'albums.php',
            method: 'GET',
            data: {
                genre
            },
            success: function(albums) {
                albums.forEach((album) => {
                    var placeholders = {
                        posterUrl: album.poster,
                        title: album.title,
                        author: album.author,
                        genre: album.genre,
                        year: album.year
                    };

                    var albumHtml = albumTemplate(placeholders);

                    $(".albums").append(albumHtml);
                });
            },
            error: function() {
                console.log('error');
            }
        });
    }

});
