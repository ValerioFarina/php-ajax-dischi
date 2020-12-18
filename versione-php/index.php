<?php
    require '../albums.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Albums - Versione PHP</title>
        <link rel="stylesheet" href="../dist/app.css">
        <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
        <script src="../dist/app.js" charset="utf-8"></script>
    </head>
    <body>
        <header>

        </header>

        <main>
            <div class="container">
                <div class="filter-genre">
                    <select class="genres">
                        <option value="All">--- select genre ---</option>
                        <option value="Rock">Rock</option>
                        <option value="Pop">Pop</option>
                        <option value="Jazz">Jazz</option>
                        <option value="Metal">Metal</option>
                        <option value="Hip hop">Hip hop</option>
                    </select>
                </div>

                <div class="albums">
                    <?php
                    foreach ($albums as $album) { ?>
                        <div class="album">
                            <div class="poster">
                                <img src="<?php echo $album["poster"]; ?>" alt="<?php echo $album["title"]; ?>">
                            </div>
                            <div class="info">
                                <h4 class="title">
                                    <?php echo $album["title"]; ?>
                                </h4>
                                <h5 class="author">
                                    <?php echo $album["author"]; ?>
                                </h5>
                                <h5 class="genre">
                                    <?php echo $album["genre"]; ?>
                                </h5>
                                <h5 class="year">
                                    <?php echo $album["year"]; ?>
                                </h5>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </div>
        </main>


        <!-- ******************** handlebars' templates ******************** -->

        <!-- this is the template of an album's card -->
        <script id="album-template" type="text/x-handlebars-template">
            <div class="album">
                <div class="poster">
                    <img src="{{ posterUrl }}" alt="{{ title }}">
                </div>
                <div class="info">
                    <h4 class="title">
                        {{ title }}
                    </h4>
                    <h5 class="author">
                        {{ author }}
                    </h5>
                    <h5 class="genre">
                        {{ genre }}
                    </h5>
                    <h5 class="year">
                        {{ year }}
                    </h5>
                </div>
            </div>
        </script>
    </body>
</html>
