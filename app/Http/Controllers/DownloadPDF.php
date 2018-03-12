<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DownloadPDF extends Controller
{
    public function downloadPackingSlip(Request $request){

    	$invno = $_GET['invno'];

		$filename = "packingslip_".$invno."_*.pdf";
		
		$tempImage = tempnam(sys_get_temp_dir(), $filename);
		
		copy(public_path("PDF/invoice/packingslip_".$invno."_1.pdf"), $tempImage);

		return response()->download($tempImage, $filename);    	
    }
}
