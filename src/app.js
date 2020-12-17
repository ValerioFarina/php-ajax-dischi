const $ = require('jquery');

$(document).ready(function() {
    var albumHtml = $('#album-template').html();

    var albumTemplate = Handlebars.compile(albumHtml);

    $.ajax({
        url: 'albums.php',
        method: 'GET',
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

    $("select.genres").change(function() {
        $(".albums").empty();

        var selectedGenre = $("select.genres").val();

        $.ajax({
            url: 'albums.php',
            method: 'GET',
            data: {
                genre: selectedGenre
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
    });


});
