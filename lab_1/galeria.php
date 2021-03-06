<?php
function createGallery($rows, $columns, $photosCount): string
{
    $galleryHtml = "<table class='table text-center'>";
    $index = 1;

    for ($r = 0; $r < $rows; $r++) {
        $galleryHtml .= "<tr>";
        for ($c = 0; $c < $columns; $c++) {
            $fileName = "obraz$index";
            $galleryHtml .= "<td><img src='thumbnails/$fileName.JPG' alt='$fileName'></td>";
            $index++;
            if ($index > $photosCount)
                $index = 1;
        }
        $galleryHtml .= "</tr>";
    }
    $galleryHtml .= "</table>";
    return $galleryHtml;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"></script>
    <title>Galeria zdjęć</title>
</head>
<body>
<div class="container my-4">
    <h1 class="text-center mb-4">Galeria zdjęć</h1>
    <table>
        <?php
        $gallery = createGallery(3, 4, 10);
        print $gallery;
        ?>
    </table>
</div>
</body>
</html>