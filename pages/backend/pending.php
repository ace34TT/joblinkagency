<?php $title = "Accueil"; ?>

<?php ob_start(); ?>
<div class="container mt-4">
    <div class="row">
        <h1>Dépôt de dossiers</h1>
    </div>
    <div class="container">
        <div class='filters'>
            <div class="row">
                <div class="col-4 filter-container">
                    <input autocomplete='off' class='filter' name='Id' placeholder='Id' data-col='id' />
                </div>
                <div class="col-4">
                    <input autocomplete='off' class='filter' name='Nom' placeholder='Nom' data-col='nom' />
                </div>
                <div class="col-4">
                    <input autocomplete='off' class='filter' name='Region' placeholder='Region' data-col='region' />
                </div>
            </div>
            <div class='clearfix'></div>
        </div>
    </div>
    <div class="container">
        <table class="table table-hover">
            <thead>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Region</th>
                <th scope="col"></th>
            </thead>
            <tbody>
                <?php
                if ($candidates != null) {
                    foreach ($candidates as $candidate) {
                ?>
                        <tr>
                            <td scope="row"><?= $candidate['id'] ?></td>
                            <td> <a href="index.php?action=candidate_card&amp;id=<?= $candidate['id'] ?>"> <?= $candidate['fullname'] ?> </a></td>
                            <td><?= $candidate['email'] ?></td>
                            <td><?= $candidate['phone'] ?></td>
                            <td><?= $candidate['region'] ?></td>
                            <td><a href="index.php?action=save_pending&amp;id=<?= $candidate['id'] ?>">Enregistrer</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</div>
<?php $content = ob_get_clean(); ?>


<?php ob_start(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src='assets/js/multifilter.js'></script>
<script type='text/javascript'>
    //<![CDATA[
    $(document).ready(function() {
        $('.filter').multifilter()
    })
    //]]>    
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
<?php $scripts = ob_get_clean(); ?>

<?php require('template.php'); ?>