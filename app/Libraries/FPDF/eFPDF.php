<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 2/22/16
 * Time: 11:12 AM
 */

namespace App\Libraries\FPDF;

use App\Libraries\FPDF\Barcode;
use App\Libraries\FPDF\FPDF;


class eFPDF extends FPDF{

    function __construct()
    {
        parent::FPDF();
    }

    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
    {
        $font_angle+=90+$txt_angle;
        $txt_angle*=M_PI/180;
        $font_angle*=M_PI/180;

        $txt_dx=cos($txt_angle);
        $txt_dy=sin($txt_angle);
        $font_dx=cos($font_angle);
        $font_dy=sin($font_angle);

        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
}