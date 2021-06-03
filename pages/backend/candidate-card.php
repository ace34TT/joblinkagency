    <?php $title = "Candidate card"; ?>
    <?php ob_start(); ?>
    <div class="container-fluid ml-1 mr-1 mt-4 mb-4 shadow-lg border">
        <div class="row text-center">
            <h1 class="mt-4 mb-4 " style="font-family: 'Arvo', serif;font-family: 'Oswald', sans-serif;">Pretest form</h1>
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
                        <p> <B>Fullname :</B> <?= $candidate['fullname'] ?></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p> <B>Height :</B> <?= $candidate['height'] ?> m</p>
                        </div>
                        <div class="col-md-6">
                            <p> <B>weight :</B> <?= $candidate['weight'] ?> kg</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p> <B>Gender :</B> <?= $candidate['sexe'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p> <B>Age :</B> <?= date("Y") - explode('-', $candidate['dateOfBirth'])[0] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <p> <B>Province :</B> <?= $candidate['region'] ?></p>
                    </div>
                    <div class="row">
                        <p> <B>Post :</B> <?= $candidate['post'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 border shadow-sm">
                <embed src="assets/resumes/<?= $candidate['email'] ?>.pdf" type="application/pdf" width="100%" height="665px" />
            </div>
        </div>
        <div class="row text-center">
            <h1 class="mt-4 mb-4 " style="font-family: 'Arvo', serif;font-family: 'Oswald', sans-serif;">Comment(s)</h1>
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
                                    <p><?= $comment['value'] ?> </p>
                                    <footer class="blockquote-footer"> <?= $comment['created_at'] ?></footer>
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
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>