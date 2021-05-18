<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title> PDF Maker </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

    <h1>Table SQL en PDF</h1>

    <hr/>

    <form action="sql2pdf.php" method="post" class="row g-4 center">
        <div class="grid">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <label for="nom_bdd" class="form-label">Nom de la base de donnée (l'host est localhost)</label>
                    <input type="text" class="form-control" id="nom_bdd" name="nom_bdd" placeholder="db-name" required>
                </div>
                <div class="col-md-3">
                    <label for="nom_user" class="form-label">Nom utilisateur de la base de donnée</label>
                    <input type="text" class="form-control" id="nom_user" name="nom_user" placeholder="db-user" required>
                </div>
                <div class="col-md-3">
                    <label for="mdp_user" class="form-label">Mot de passe de l'utilisateur de la base de donnée</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend">*</span>
                        <input type="password" class="form-control" id="mdp_user" placeholder="db-mdp">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <label for="nom_table" class="form-label">Nom de la table</label>
                    <input type="text" class="form-control" id="nom_table" name="nom_table" placeholder="masupertable" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <label for="nom_pdf" class="form-label">Titre du pdf</label>
                    <input type="text" class="form-control" id="nom_pdf" name="nom_pdf" placeholder="Mon pdf" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <label for="text_pdf" class="form-label">Texte du pdf (optionnel)</label>
                    <input type="text" class="form-control" id="text_pdf" name="text_pdf" placeholder="Ceci est la courte description de mon pdf">
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
    <button class="btn btn-primary" type="submit">Créer le pdf</button>
    </div>
</form>
</body>
</html>