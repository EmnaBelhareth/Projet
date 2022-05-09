<?php
	function generateRow(){
		$contents = '';
		include_once('connexion.php');
		$sql = "SELECT * FROM etudiant";

		//use for MySQLi OOP
		$query = $pdo->query($sql);
		while($row = $query->fetch()){
			$contents .= "
			<tr>
            <td>".$row['cin']."</td>
            <td>".$row['nom']."</td>
            <td>".$row['prenom']."</td>
            <td>".$row['adresse']."</td>
            <td>".$row['email']."</td>
            <td>".$row['Classe']."</td>
			</tr>
			";
		}
		
		return $contents;
	}

	require_once('tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Generated PDF using TCPDF");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
      	<h2 align="center">Generated PDF using TCPDF</h2>
      	<h4>Members Table</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="5%">Cin</th>
				<th width="20%">nom</th>
				<th width="20%">prenom</th>
				<th width="25%">Adresse</th> 
                <th width="25%">email</th>
                <th width="5%">classe</th>
           </tr>  
      ';  
    $content .= generateRow();  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('etudiants.pdf', 'I');
	

?>