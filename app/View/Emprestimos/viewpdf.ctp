<?php 
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("Biblioteca pública da Escola Padre Arlindo"); 
$tcpdf->SetAutoPageBreak( false ); 
$tcpdf->setHeaderFont(array($textfont,'',40)); 
$tcpdf->xheadercolor = array(150,0,0); 
$tcpdf->xheadertext = 'Padre Arlindo Vieira'; 
$tcpdf->xfootertext = 'Copyright 2014. Vinicius Martins Ferraz. Todos os direitos reservados.'; 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 

// Now you position and print your page content 
// example:  
$tcpdf->SetTextColor(0, 0, 0); 
$tcpdf->SetFont($textfont,'B',20); 
$tcpdf->Cell(0,14, "Comprovante de retirada", 0,1,'L'); 

// set cell padding
$tcpdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$tcpdf->setCellMargins(1, 1, 1, 1);

// set color for background
$tcpdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, 
// $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$tcpdf->SetFont($textfont,'',10); 
$txt = '<table>'
        . '<tr>'
        . ' <td><b>ALUNO</b></td>'
        . ' <td><b>RA</b></td>'
        . ' <td><b>EMAIL</b></td>'
        . '</tr>'
        . '<tr>'
        . ' <td>'.$emprestimos[0][0]['aluno'].'</td>'
        . ' <td>'.$emprestimos[0][0]['ra'].'</td>'
        . ' <td>'.$emprestimos[0][0]['email'].' </td>'
        . '</tr>'
     . '</table>'
        . '<br>'
        . '<table>'
        .  '<tr>'
        .   ' <td><b>TÍTULO</b></td>'
        .   ' <td><b>PRAZO DEVOLUÇÃO</b></td>'
        . '</tr>';
foreach($emprestimos as $emp){  
      $txt .=  '<tr>
               <td>'.$emp[0]['titulo'].'</td>
               <td>'.$this->Time->format($emp[0]['prazo_devolucao'], '%d/%m/%Y').'</td>
        </tr>';
 }
 $txt .= '</table>';
$tcpdf->MultiCell(190, 100, $txt,
        1, 'J', 0, 0, '', '50',false ,1, true, true,0);
// ... 
// etc. 
// see the TCPDF examples  
$file = $email.rand(0,1000000).'.pdf';
$tcpdf->Output('/tmp/'.$file, 'F'); 

$this->requestAction(array('controller'=>'Emprestimos','action'=>'email/'.$email.'/'.$file));
?>