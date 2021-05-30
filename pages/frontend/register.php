<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/registration.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <title>Registration</title>
</head>

<body>
    <div class="container-fluid register">
        <div class="row">
            <div class="col-md-3 register-left">
                <!-- <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" /> -->
                <!-- <h3>Welcome</h3>
                <p>You are 30 seconds away from earning your own money!</p> -->
                <?php
                if (isset($id)) {
                    echo ('your id is ' . $id);
                }
                ?>
                <input type="submit" onclick="window.location='index.php';" name="" value="Home" /><br />
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Informations personnelles</h3>
                        <form action="index.php?action=registration_post" method="post" enctype="multipart/form-data">
                            <div class="row register-form">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="fullname" class="form-control" placeholder="Nom comptel *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="dateOfBirth" class="form-control" placeholder="Date de naissance *" value="" />
                                    </div>
                                    <div class="form-group pt-1 ml-2">
                                        <div class="">
                                            <label class="radio inline">
                                                <input name="sexe" type="radio" name="gender" value="Homme" checked>
                                                <span> Homme </span>
                                            </label>
                                            <label class="radio inline">
                                                <input name="sexe" type="radio" name="gender" value="Femme">
                                                <span>Femme </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="height" step="0.01" class="form-control" placeholder="Taille *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="weight" step="0.01" class="form-control" placeholder="Poids *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="region">
                                            <option class="hidden" selected disabled>Région</option>
                                            <option selected>Région</option>
                                            <option value="Analamanga">Analamanga </option>
                                            <option value="Bongolava">Bongolava </option>
                                            <option value="Itasy">Itasy </option>
                                            <option value="Vakinakaratra">Vakinakaratra </option>
                                            <option value="Amoroni Mania">Amoroni Mania </option>
                                            <option value="Atsimo-Atsinanana">Atsimo-Atsinanana </option>
                                            <option value="Haute Mtsiatra">Haute Mtsiatra </option>
                                            <option value="Vatovavy-Fitovinany">Vatovavy-Fitovinany </option>
                                            <option value="Ihorombe">Ihorombe </option>
                                            <option value="Alaotra Mangoro">Alaotra Mangoro </option>
                                            <option value="Analanjorofo">Analanjorofo </option>
                                            <option value="Antsinanana">Antsinanana </option>
                                            <option value="Betsiboka">Betsiboka </option>
                                            <option value="Boeny">Boeny </option>
                                            <option value="Melaky">Melaky </option>
                                            <option value="Sodia">Sofia </option>
                                            <option value="Androy">Androy </option>
                                            <option value="Anosy">Anosy </option>
                                            <option value="Atsimo-Andrefana">Atsimo-Andrefana </option>
                                            <option value="Menabe">Menabe </option>
                                            <option value="Diana">Diana </option>
                                            <option value="Sava">Sava </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" minlength="10" maxlength="10" class="form-control" placeholder="Téléphone *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="destination">
                                            <option selected>Pour</option>
                                            <?php
                                            foreach ($recruiters as $recruiter) {
                                            ?>
                                                <option value=" <?= $recruiter['id'] ?>"><?= $recruiter['name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="post" class="form-control" placeholder="Post *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="resume" class="form-control" placeholder="Resume *" value="" />
                                    </div>
                                    <input type="submit" class="btnRegister" value="Postuler" />
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>