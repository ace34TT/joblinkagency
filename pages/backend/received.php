<?php $title = "Reçus"; ?>

<?php ob_start(); ?>
<div class="container mt-4">
    <div class="row">
        <h1>Liste candidats reçus</h1>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom complet</th>
                <th scope="col">Email</th>
                <th scope="col">Région</th>
                <th scope="col">Poste</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($candidates != null) {
                foreach ($candidates as $candidate) {
            ?>
                    <tr>
                        <th scope="row"><?= $candidate['id'] ?></th>
                        <td> <a href="index.php?action=candidate_card&amp;id=<?= $candidate['id'] ?>"> <?= $candidate['fullname'] ?> </a></td>
                        <td><?= $candidate['email'] ?></td>
                        <td><?= $candidate['region'] ?></td>
                        <td><?= $candidate['post'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); ?>


<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>

<?php require('template.php'); ?>