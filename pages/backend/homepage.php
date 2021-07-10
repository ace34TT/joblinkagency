<?php $title = "Accueil"; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row mt-5 ">
        <div class="row">
            <h1>En traitement</h1>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">En attentes</h5>
                    <p class="card-text">
                        <?php
                        if (isset($pending)) {
                            echo (count($pending));
                        } else {
                            echo (0);
                        }
                        ?>
                    </p>
                    <a href="index.php?action=pending_list" class="btn btn-primary">Procéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 offset-1">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Présélection</h5>
                    <p class="card-text">
                        <?php
                        if (isset($pretest)) {
                            echo (count($pretest));
                        } else {
                            echo (0);
                        }
                        ?>
                    </p>
                    <a href="index.php?action=pretest_list" class="btn btn-primary">Procéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 offset-1">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Test final</h5>
                    <p class="card-text">
                        <?php
                        if (isset($finaltest)) {
                            echo (count($finaltest));
                        } else {
                            echo (0);
                        }
                        ?></p>
                    <a href="index.php?action=finaltest_list" class="btn btn-primary">Procéder</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-5">
        <div class="row">
            <h1>Non reçus</h1>
        </div>
        <div class="col-md-4 offset-1">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Présélection</h5>
                    <p class="card-text">
                        <?php
                        if (isset($pretestfail)) {
                            echo (count($pretestfail));
                        } else {
                            echo (0);
                        }
                        ?>
                    </p>
                    <a href="index.php?action=pretestfail_list" class="btn btn-primary">Procéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 offset-2">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Test final</h5>
                    <p class="card-text">
                        <?php
                        if (isset($finaltestfail)) {
                            echo (count($finaltestfail));
                        } else {
                            echo (0);
                        }
                        ?>
                    </p>
                    <a href="index.php?action=finaltestfail_list" class="btn btn-primary">Pocéder</a>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row mt-5">
        <div class="row">
            <h1>Reçus</h1>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Reçus test final</h5>
                    <p class="card-text">
                        <?php
                        if (isset($received)) {
                            echo (count($received));
                        } else {
                            echo (0);
                        }
                        ?>
                    </p>
                    <a href="index.php?action=received_list" class="btn btn-primary">Lister</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>


<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>

<?php require('template.php'); ?>