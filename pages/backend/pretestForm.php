<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="assets/images/IMG-20210529-WA0000.jpg" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/Vendor/bootstrap/css/bootstrap.min.css">
    <link href="Assets/Images/Logo.png" rel="icon">
    <title>Préséléction <?= $candidate['fullname'] ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    </style>
</head>

<body>
    <div class="container-fluid ml-1 mr-1 mt-4 mb-4 shadow-lg border">
        <div class="row text-center">
            <h1 class="mt-4 mb-4 " style="font-family: 'Arvo', serif;font-family: 'Oswald', sans-serif;">Test form</h1>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="container border" style="font-size: 25px;">
                    <div class="row text-center mt-2">
                        <h2 style="font-family: 'Oswald', sans-serif;"> Personnal informations</h2>
                    </div>
                    <div class="row">
                        <p> <B>ID :</B> <?= $candidate['id'] ?> </p>
                    </div>
                    <div class="row">
                        <p> <B>Nom :</B> <?= $candidate['fullname'] ?></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p> <B>Taille :</B> <?= $candidate['height'] ?> m</p>
                        </div>
                        <div class="col-md-6">
                            <p> <B>Poids :</B> <?= $candidate['weight'] ?> kg</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p> <B>Sexe :</B> <?= $candidate['sexe'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p> <B>Age :</B> <?= date("Y") - explode('-', $candidate['dateOfBirth'])[0] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <p> <B>Region :</B> <?= $candidate['region'] ?></p>
                    </div>
                    <div class="row">
                        <p> <B>Poste :</B> <?= $candidate['post'] ?></p>
                    </div>
                    <div class="row text-center">
                        <h2 style="font-family: 'Oswald', sans-serif;"> Deliberation</h2>
                    </div>
                    <div class="row">
                        <form method="POST" action="index.php?action=pretest_result_post&amp;candidate_id=<?= $candidate['id'] ?>">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><B>Poste</B> :</label>
                                <input type="text" name="post" value="<?= $candidate['post'] ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><B>Commentaires</B> :</label>
                                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><B>Atrribué(e) pour</B> :</label>
                                <select class="form-control" name="recruiter_id">
                                    <option value="<?php
                                                    foreach ($recruiters as  $recruiter) {
                                                        if ($recruiter['id'] == $candidate['recruiter_id']) {
                                                            echo $recruiter['id'];
                                                        }
                                                    }
                                                    ?> " selected><?php
                                                                    foreach ($recruiters as  $recruiter) {
                                                                        if ($recruiter['id'] == $candidate['recruiter_id']) {
                                                                            echo $recruiter['name'];
                                                                        }
                                                                    }
                                                                    ?></option>
                                    <?php
                                    foreach ($recruiters as $recruiter) {
                                    ?>
                                        <option value=" <?= $recruiter['id'] ?>"><?= $recruiter['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3" hidden>
                                <label for="result" class="form-label"><B>Result</B> :</label>
                                <input type="text" id="result" value="" name="result">
                            </div>


                            <div class="row ">
                                <div class="mb-3 col-md-6 ">
                                    <button type="submit" id="success" class="offset-4 btn btn-success">Success</button>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <button type="submit" id="fail" class="offset-2 btn btn-danger">Fail</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 border shadow-sm">
                <embed src="assets/resumes/<?= $candidate['email'] ?>.pdf" type="application/pdf" width="100%" height=750px" />
            </div>

        </div>
        <div class="row text-center">
            <h1 class="mt-4 mb-4 " style="font-family: 'Arvo', serif;font-family: 'Oswald', sans-serif;">Comments</h1>
        </div>
        <div class="container">
            <div class="row ">
                <?php
                if (isset($comments)) {
                    foreach ($comments as $comment) {
                ?>
                        <div class="card">
                            <div class="card-header">
                                <?= $comment['author'] ?>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p><?= $comment['content'] ?> </p>
                                    <footer class="blockquote-footer"> <?= $comment['created_date'] ?> / event : <cite title="Source Title"> <a href="" style="text-decoration: none;"><?= $comment['events'] ?></a></cite></footer>
                                </blockquote>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        var succes = document.getElementById('success');
        var fail = document.getElementById('fail');
        var result = document.getElementById('result');
        succes.addEventListener('click', function() {
            result.value = 'finaltest'
        });
        fail.addEventListener('click', function() {
            result.value = 'pretestfail'
        });
    </script>
</body>

</html>