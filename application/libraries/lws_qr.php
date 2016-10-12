<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "phpqrcode" . DIRECTORY_SEPARATOR . "qrlib.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lws_qr
 *
 * @author nurfadillah
 */
class lws_qr {

    public $temp_dir;

    public function __construct($_temp_dir = FALSE) {
        if (!$_temp_dir) {
            $this->temp_dir = APPROOT . '_assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'qr_temp' . DIRECTORY_SEPARATOR;
        } else {
            $this->temp_dir = $_temp_dir;
        }
    }

    /**
     * 
     * @param type $code_content
     * @param type $filename
     * @param type $outer_frame
     * @param type $pixel_per_point
     * @param type $jpeg_quality
     * @return type string FILE NAME
     */
    public function create($code_content = "", $filename = "", $outer_frame = 4, $pixel_per_point = 5, $jpeg_quality = 95, $return_full_path = TRUE) {
        //generate frame

        $frame = QRcode::text($code_content, FALSE, QR_ECLEVEL_M);

        // rendering frame with GD2 (that should be function by real impl.!!!) 
        $h = count($frame);
        $w = strlen($frame[0]);

        $imgW = $w + 2 * $outer_frame;
        $imgH = $h + 2 * $outer_frame;

        $base_image = imagecreate($imgW, $imgH);

        $col[0] = imagecolorallocate($base_image, 255, 255, 255); // BG, white  
        $col[1] = imagecolorallocate($base_image, 0, 0, 0);     // FG, blue 

        imagefill($base_image, 0, 0, $col[0]);

        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                if ($frame[$y][$x] == '1') {
                    imagesetpixel($base_image, $x + $outer_frame, $y + $outer_frame, $col[1]);
                }
            }
        }

        // saving to file 
        $target_image = imagecreate($imgW * $pixel_per_point, $imgH * $pixel_per_point);

        imagecopyresized(
                $target_image, $base_image, 0, 0, 0, 0, $imgW * $pixel_per_point, $imgH * $pixel_per_point, $imgW, $imgH
        );

        imagedestroy($base_image);

        if ($filename !== "") {
            imagejpeg($target_image, $this->temp_dir . $filename, $jpeg_quality);
        } else {
            header('Content-Type: image/jpeg');
            imagejpeg($target_image);
            return FALSE;
        }

        imagedestroy($target_image);

        if($return_full_path){
            return $this->temp_dir . $filename;
        }
        return $filename;
    }

}
