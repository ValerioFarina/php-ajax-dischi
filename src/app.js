const $ = require('jquery');

$(document).ready(function() {
    var albumHtml = $('#album-template').html();

    var albumTemplate = Handlebars.compile(albumHtml);

    $.ajax({
        url: 'albums.php',
        method: 'GET',
        success: function() {
            console.log('success');
        },
        error: function() {
            console.log('error');
        }
    });

    var placeholders = {
        posterUrl: 'https://www.onstageweb.com/wp-content/uploads/2018/09/bon-jovi-new-jersey.jpg',
        title: 'New Jersey',
        author: 'Bon Jovi',
        genre: 'Rock',
        year: '1988'
    };

    for (var i = 0; i < 10; i++) {

        var album = albumTemplate(placeholders);

        $(".container.albums").append(album);
    }
});
