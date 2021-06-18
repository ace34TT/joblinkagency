<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="assets/images/IMG-20210529-WA0000.jpg" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Mis à jour cv</title>
</head>

<body>
    <div class="container ml-1 mr-1 mt-5 mb-3 shadow-lg border">
        <div class="row text-center">
            <button type="button" onclick="window.location='index.php';" class="btn btn-light border">
                << Revenir à la page d'accueil</button>
                    <h1 class="mt-4 mb-4 " style="font-family: 'Arvo', serif;font-family: 'Oswald', sans-serif;">Formulaire</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container" style="font-size: 25px;">
                    <div class="row mb-4">
                        <form action="index.php?action=update_resume" method="POST" class="mb-4" enctype="multipart/form-data">
                            <div class="form-group col-md-6 offset-3 mt-3">
                                <label for="email">Email :</label>
                                <input type="text" name="email" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6 offset-3 mt-3">
                                <label for="id">Id :</label>
                                <input type="text" name="id" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6 offset-3 mt-3">
                                <label for="resume">Nouveau CV :</label>
                                <input type="file" name="resume" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6 offset-3 mt-3">

                                <p style="color:<?php
                                                echo $message == "Votre CV a été mis à jour" ? "green" : "red";
                                                ?>">
                                    <?php
                                    echo $message != "" ? $message : "";
                                    ?>
                                </p>
                            </div>
                            <div class="form-group col-md-6 offset-3 mt-3">
                                <input type="submit" class="btn btn-danger col-6 offset-3 mt-4" id="name" value="Soumettre">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>