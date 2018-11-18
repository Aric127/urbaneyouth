<?php

require('fpdf.php');

class PDF extends FPDF {

// Load data
    function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

// Simple table
    function SignUp($data) {
    
		
    	$this->SetFont('Arial', '', 12);
        $this->Rect(10, 10, 190, 110); // rectangle 140 last line set up
        $this->Cell(190,7,'Bill Invoice',0,1,'C');
        $this->Cell(30,7,'OyaCharge'	,0,1,'LR');
		
        $this->SetFont('','',9);
        $this->Cell(155,3.5,ucwords($data[0]->biller_company_name),0,0,'LR');
        $this->Cell(35,3.5,'',0,1,'R');
        $this->Cell(155,3.5,'Service -'.$data[0]->biller_category_name,0,0,'LR');
		
        $this->Cell(30,3.5,'',0,1,'L');
		 $this->Image($data['image'].'/'.$data[0]->biller_company_logo,170,12,25);
     //   $this->Cell(155,3.5,$data[0]->biller_company_logo,0,0,'LR');
        $this->Cell(30,3.5,'Consumer No:- '.$data[0]->biller_customer_id_no,0,1,'L');
		// $this->Ln(1);
        $this->Line(10, 35, 200, 35);
        $this->Cell(200,2,'',0,2,'LR');
        $this->Cell(155,3,'To,',0,0,'LR');
        $this->SetFont('','B',9);
        $this->Cell(30,3,'Date:-'.$data[0]->bill_invoice_date,0,1,'L');
        $this->SetFont('','',9);
        $this->Cell(30,3,ucwords($data[0]->biller_user_name),0,1,'LR');
        $this->Cell(200,3,'',0,1,'LR');
        $this->Cell(155,3,'',0,0,'LR');
      
		$this->Cell(30,3,'Last Date:- '.$data[0]->bill_due_date,0,1,'L');
        $this->Line(10, 50, 200, 50);
        $this->Cell(200,3,'',0,2,'LR');
	
        $this->Cell(155,2,'Description',0,0,'LR');
		
        $this->Line(160, 102, 160, 55);   // Bill amount horizontle line
        $this->Cell(30,2,'Bill Amount',0,1,'LR');
        $this->Line(10, 55, 200, 55);  // description below line
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
$this->MultiCell(150,5,$data[0]->bill_product_name."."." ".$data[0]->bill_description);
 
      //  $this->Cell(155,3,strip_tags($data[0]->bill_description),0,0,'L');
        $this->Cell(30,3,'',0,1,'L');
        $this->Line(10, 93, 200, 93); // before total line
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->SetFont('','B',10);
        $this->Cell(155,3,'Total',0,0,'LR');
        $this->Cell(30,3,$data[0]->bill_amount,0,1,'L');
        $this->SetFont('','',8);
        $this->Line(10, 102, 200, 102); /// below line of total
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Line(100, 120, 100, 93);  //	total horizontal line
        $this->SetFont('','',10);
        $this->Cell(30,3,'Bill Consumer No.:',0,0,'L');
        $this->SetFont('','B',10);
        $this->Cell(105,3,$data[0]->biller_customer_id_no,0,0,'L');
        $this->Cell(30,3,'OyaCharge',0,1,'L');
        $this->Cell(200,2,'',0,2,'LR');
        $this->SetFont('','B',10);
        $this->Cell(135,3,'via OyaCharge',0,0,'L');   
		  
        $this->Cell(30,3,$data[0]->biller_company_name,0,1,'L');                
        $this->SetFont('','',8);
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(135,3,'',0,0,'LR');
        $this->Cell(30,3,'('.$data[0]->biller_name.')',0,1,'L');
        $this->Ln();
    }
    
    function bill_recipt($data) {
      	$this->SetFont('Arial', '', 12);
        $this->Rect(10, 10, 190, 120); // rectangle 140 last line set up
        $this->Cell(190,7,'Bill Receipt',0,1,'C');
        $this->Cell(30,7,'Recharge'	,0,1,'LR');
		
        $this->SetFont('','',9);
        $this->Cell(155,3.5,ucwords($data[0]->biller_company_name),0,0,'LR');
        $this->Cell(35,3.5,'',0,1,'R');
        $this->Cell(155,3.5,'Service -'.$data[0]->biller_category_name,0,0,'LR');
		
        $this->Cell(30,3.5,'',0,1,'L');
		 $this->Image($data['image'].'/'.$data[0]->biller_company_logo,170,12,25);
     //   $this->Cell(155,3.5,$data[0]->biller_company_logo,0,0,'LR');
        $this->Cell(30,3.5,'Consumer No:- '.$data[0]->biller_customer_id_no,0,1,'L');
		// $this->Ln(1);
        $this->Line(10, 35, 200, 35);
        $this->Cell(200,2,'',0,2,'LR');
        $this->Cell(145,4,'To,',0,0,'LR');
        $this->SetFont('','B',9);
        $this->Cell(30,3,'Date:-'.$data[0]->bill_pay_date,0,1,'L');
        $this->SetFont('','',9);
        $this->Cell(30,3,ucwords($data[0]->biller_user_name),0,1,'LR');
        $this->Cell(200,3,'',0,1,'LR');
        $this->Cell(130,3,'',0,0,'LR');
      
		$this->Cell(30,3,'Transaction No:- '.$data[0]->bill_transaction_id,0,1,'L');
        $this->Line(10, 50, 200, 50);
        $this->Cell(200,3,'',0,2,'LR');
	
        $this->Cell(155,2,'Description',0,0,'LR');
		
        $this->Line(160, 90, 160, 50);   // Bill amount vertical line
        $this->Cell(30,2,'Bill Amount',0,1,'LR');
        $this->Line(10, 55, 200, 55);  // description below line
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
$this->MultiCell(150,5,"Bill successfully Paid");
      //  $this->Cell(155,3,strip_tags($data[0]->bill_description),0,0,'L');
        $this->Cell(30,3,'',0,1,'L');
        $this->Line(10, 100, 200, 100); // line
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->SetFont('','B',10);
        $this->Cell(155,3,'Total',0,0,'LR');
        $this->Cell(30,3,$data[0]->bill_amount,0,1,'L');
        $this->SetFont('','',8);
        $this->Line(10, 90, 200, 90); /// below line
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Line(100, 130, 100, 90);  //	total vertical line(130 show height)
        $this->SetFont('','',10);
        $this->Cell(30,3,'Bill Consumer No.:',0,0,'L');
        $this->SetFont('','B',10);
        $this->Cell(105,3,$data[0]->biller_customer_id_no,0,0,'L');
        $this->Cell(30,3,'Recharge',0,1,'L');
        $this->Cell(200,2,'',0,2,'LR');
        $this->SetFont('','B',10);
        $this->Cell(135,3,'via Recharge',0,0,'L');   
		  
        $this->Cell(30,3,$data[0]->biller_company_name,0,1,'L');                
        $this->SetFont('','',8);
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(135,3,'',0,0,'LR');
        $this->Cell(30,3,'('.$data[0]->biller_name.')',0,1,'L');
        $this->Ln();
    }
    
    function Service($data) {
        $this->SetFont('Arial', '', 12);
        $this->Rect(10, 10, 190, 110);
        $this->Cell(190,7,'Payment Receipt',0,1,'C');
        $this->Cell(30,7,MAIN_TITLE,0,1,'LR');
        $this->SetFont('','',9);
        $this->Cell(155,3.5,'Chartered Accountants',0,0,'LR');
        $this->Cell(30,3.5,'Phones:- (O)',0,1,'L');
        $this->Cell(155,3.5,'120 - 121, First Floor, Manas Bhawan',0,0,'LR');
        $this->Cell(30,3.5,'0731-2517765',0,1,'L');
        $this->Cell(155,3.5,'11 R.N.T. Marg Indore',0,0,'LR');
        $this->Cell(30,3.5,'9425066440',0,1,'L');
        $this->Line(10, 35, 200, 35);
        $this->Cell(200,2,'',0,2,'LR');
        $this->Cell(155,3,'To,',0,0,'LR');
        $this->SetFont('','B',9);
        $this->Cell(30,3,'RN:- WEB/'.str_pad($data[0]->receipt_id, 3, "0", STR_PAD_LEFT),0,1,'L');
        $this->SetFont('','',9);
        $this->Cell(30,3,ucwords($data[0]->name),0,1,'LR');
        $this->Cell(200,3,$data[0]->full_address,0,1,'LR');
        $this->Cell(155,3,'',0,0,'LR');
        $this->Cell(30,3,'Date:- '.date('d/m/Y'),0,1,'L');
        $this->Line(10, 50, 200, 50);
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(155,2,'Particulars',0,0,'LR');
        $this->Line(160, 95, 160, 50);
        $this->Cell(30,2,'Amt Rs.',0,1,'LR');
        $this->Line(10, 55, 200, 55);
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(155,3,'Income Tax Return Tax Amount and',0,0,'LR');
        $this->Cell(30,3,$data[0]->tax_amount,0,1,'L');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(155,3,'Add:- Service Charges',0,0,'LR');
        $this->Cell(30,3,$data[0]->service_charges,0,1,'L');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(155,3,'Add:- Service Tax @ '.(($data[0]->service_tax/$data[0]->service_charges)*100).'%',0,0,'LR');
        $this->Cell(30,3,$data[0]->service_tax,0,1,'L');
        $this->Line(10, 85, 200, 85);
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->SetFont('','B',10);
        $this->Cell(155,3,'Total',0,0,'LR');
        $this->Cell(30,3,$data[0]->total,0,1,'L');
        $this->SetFont('','',8);
        $this->Line(10, 95, 200, 95);
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Line(100, 120, 100, 95);
        $this->SetFont('','',10);
        $this->Cell(30,3,'Payment Tax No.:',0,0,'L');
        $this->SetFont('','B',10);
        $this->Cell(105,3,$data[0]->transaction_id,0,0,'L');
        $this->Cell(30,3,'For, '.MAIN_TITLE,0,1,'L');
        $this->Cell(200,2,'',0,2,'LR');
        $this->SetFont('','B',10);
        $this->Cell(135,3,'via payumoney',0,0,'L');     
        $this->Cell(30,3,'Chartered Accountants',0,1,'L');                
        $this->SetFont('','',8);
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(200,3,'',0,2,'LR');
        $this->Cell(135,3,'',0,0,'LR');
        $this->Cell(30,3,'(Narandra Bhandari)',0,1,'L');
        $this->Ln();
    }
}

//$pdf = new PDF();
//// Data loading
//$pdf->AddPage();
//$pdf->Service();
//$pdf->AddPage();
//$pdf->SignUp();
//$pdf->Output();
?>
