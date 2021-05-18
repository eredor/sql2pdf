<?php
require('fpdf183/fpdf.php');

 $DB_DSN = "mysql:host=localhost;dbname=".htmlspecialchars($_POST['nom_bdd']);
 $DB_USER = htmlspecialchars($_POST['nom_user']);
 if(isset($_POST['mdp_user'])){
 	$DB_PASS = htmlspecialchars($_POST['mdp_user']);
 }
 else $DB_PASS = "";
 $TABLE = htmlspecialchars($_POST['nom_table']);

class PDF extends FPDF {

    // En-tête
    function Header() {
        $this->SetFont('Times','B',15); // Police Times Gras 15
        $this->Cell(80); // Décalage à droite
        $this->Cell(30,10, utf8_decode(htmlspecialchars($_POST['nom_pdf'])) ,0,0,'C'); // Titre
		$this->Ln(5); // Saut de ligne

        $this->SetFont('Times','',9);
		$this->Cell(80);
		if(isset($_POST['text_pdf'])){
			$TEXT_PDF = htmlspecialchars($_POST['text_pdf']);
		}
		else $$TEXT_PDF = "";
		$this->Cell(30,10,utf8_decode($TEXT_PDF),0,0,'C');
        $this->Ln(15);
    }

	// Tableau
	function FancyTable($noms_colonne, $data) {
		// Ligne avec le nom des colonnes 
		$this->SetFillColor(164,59,100); // Fond magenta
		$this->SetTextColor(255); // Texte en blanc
		$this->SetDrawColor(0); // Ligne en noir
		$this->SetLineWidth(.3); // Largeur lignes
		$this->SetFont('','B'); // Ne change pas la police, met juste en gras
		for($i=0;$i<count($noms_colonne);$i++)
			$this->Cell(190/(count($noms_colonne)),7,$noms_colonne[$i],1,0,'C',true);
		$this->Ln(); // Passe à la ligne suivante

		// Ligne de contenu issu de la BDD
		$fill = false; // Une ligne sur deux aura un fond coloré pour rendre la lecture aisee
		$this->SetFillColor(206,188,215); // Cette couleur sera violet clair
		$this->SetTextColor(0); // Texte en noir
		$this->SetFont(''); // Ne change pas la police, enleve l'effet gras

		foreach($data as $row) {
            for($i=0;$i<count($noms_colonne);$i++) {
                $this->Cell(190/(count($noms_colonne)),6,utf8_decode($row[$noms_colonne[$i]]),'LR',0,'L',$fill);
            }
            $this->Ln();
            $fill = !$fill;
		}
		// Trait de terminaison
		$this->Cell(190,0,'','T');
	}

	//Pied de page
	function Footer() {
    	// Positionnement à 1,5 cm du bas
    	$this->SetY(-15);
    	$this->SetFont('Times','I',8);
    	// Numéro de page
    	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

}

$pdf = new PDF();
$pdf->AliasNbPages(); // Permet de gerer {nb}

//Connexion a la BDD
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
$PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);

// Recuperation des donnees de la table
$sql = "SELECT * FROM `$TABLE`";
$results = $PDO->query($sql);    
$data = $results->fetchAll(PDO::FETCH_ASSOC);

// Recuperation du nom des colonnes de la table
$results = $PDO->query("DESCRIBE `$TABLE`");
$noms_colonne = $results->fetchAll(PDO::FETCH_COLUMN);


$pdf->SetFont('Times','',9);
$pdf->AddPage();
$pdf->FancyTable($noms_colonne,$data);
$pdf->Output('I',$TABLE.'.pdf', true); // Affiche dans le navigateur le pdf cree
?>