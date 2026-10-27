<?php defined('BASEPATH') OR exit('No direct script access allowed');


require_once APPPATH.'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf
{

protected function ci()
{
    return get_instance();
}

public function __construct() {
        
        require_once APPPATH.'third_party/dompdf/autoload.inc.php';
        
        $pdf = new DOMPDF();
        
        $CI =& get_instance();
        $CI->dompdf = $pdf;
        
    }
}