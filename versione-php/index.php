<?php
    require 'albums.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Albums - Versione PHP</title>
        <link rel="stylesheet" href="../dist/app.css">
    </head>
    <body>
        <header>

        </header>

        <main>
            <div class="container albums">
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
        </main>
    </body>
</html>
