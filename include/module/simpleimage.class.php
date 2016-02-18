<?php
 
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage {

   const BORDER_PATH = "img/chalk_border.png";
   const BORDER_PATH_JPG = "img/chalk_border.jpg";
   const FONT_PATH = "img/font/Arial.ttf";
   const LOGO_IMG_PATH = "img/logo_small_transparent.png";
   const FONT_SIZE_MAX = 24;
   const FONT_SIZE_MIN = 14;
   const TEXT_PADDING_LEFT = 50;
   const TEXT_PADDING_TOP = 65;
   const MIN_CHARS_IN_LINE = 10;
   const TEXT_PART_HEIGHT = 100;
   const WHOLE_IMAGE_WIDTH = 670;
   const OUTER_BORDER_WIDTH = 15;
   const INNER_BORDER_WIDTH = 5;
   const IMAGE_TEXT_SPAN = 15;
   const TEXT_IMAGE_HEIGHT = 300;


   var $image;
   var $image_type;

   
   
   function create($text){

       $this->image = $this->createBlankImage(self::WHOLE_IMAGE_WIDTH, self::TEXT_IMAGE_HEIGHT, 214, 222, 229);

       $this->insertLogo($this->image, self::LOGO_IMG_PATH, 0, imagesy($this->image));

       $color = imagecolorallocate($this->image, 0, 0, 0);

       $maxTextBoxHeight =  $this->getHeight() - self::TEXT_PADDING_TOP * 2;
       $maxTextBoxWidth = $this->getWidth() - self::TEXT_PADDING_LEFT * 2;

       $textParams = $this->fittTextToIamage($text, self::FONT_PATH, $maxTextBoxHeight, $maxTextBoxWidth) ;

       if($textParams == null){
           return false;
       }

       $position = $this->getCenterStartPosition($textParams->box, Array($maxTextBoxWidth, $maxTextBoxHeight));
       //var_dump(Array('$maxTextBoxWidth' => $maxTextBoxWidth, '$maxTextBoxHeight' => $maxTextBoxHeight));

       //var_dump($textParams);

       //var_dump($position);

       //var_dump(Array("x" =>  self::TEXT_PADDING_LEFT + $position[0], "y" => self::TEXT_PADDING_TOP + 20 + $position[1]));
       imagettftext($this->image, $textParams->fontSize, 0, self::TEXT_PADDING_LEFT + $position[0], self::TEXT_PADDING_TOP  + 20 + $position[1], $color, self::FONT_PATH, $textParams->text);

       return true;
       
   }

  function createWithImage($img_src, $text){
        $upImage = $this->load($img_src);

        $upImage = $this->resizeImageToWidth($upImage, self::WHOLE_IMAGE_WIDTH - self::OUTER_BORDER_WIDTH * 2 - self::INNER_BORDER_WIDTH * 2);

        $this->insertLogo($upImage, self::LOGO_IMG_PATH, 0, imagesy($upImage));

        $upImage = $this->insertBorder($upImage, self::INNER_BORDER_WIDTH);

        $newHeight = imagesy($upImage) + self::OUTER_BORDER_WIDTH * 3 + self::TEXT_PART_HEIGHT;// OUTER_BORDER_WIDTH * 3  = top + middle + bottom borders

        $this->image = $this->createBlankImage(self::WHOLE_IMAGE_WIDTH, $newHeight, 214, 222, 229);

        imagecopy($this->image, $upImage, self::OUTER_BORDER_WIDTH, self::OUTER_BORDER_WIDTH, 0, 0, imagesx($upImage), imagesy($upImage));

        $textParams = $this->fittTextToIamage($text, self::FONT_PATH, self::TEXT_PART_HEIGHT, self::WHOLE_IMAGE_WIDTH - self::OUTER_BORDER_WIDTH * 2) ;

        if($textParams == null){
           return false;
        }

        $color = imagecolorallocate($this->image, 0, 0, 0);

        $this->insertCenteredText($this->image, $textParams, self::OUTER_BORDER_WIDTH, imagesy($upImage) + self::OUTER_BORDER_WIDTH * 2 + IMAGE_TEXT_SPAN + self::INNER_BORDER_WIDTH, $color, self::FONT_PATH);

        return true;
   }

   function createSmpleImage($img_src){
        $this->image = $this->load($img_src);

        $this->insertLogo($this->image, self::LOGO_IMG_PATH, 0, imagesy($this->image));

        if($this->getWidth() > 670) {
            $this->resizeToWidth(670);
        }else { //jeżeli obrazek jest mniejszy niż limit szerokości to jest kompresowany żeby mniej ważył
            $this->resizeToWidth($this->getWidth());
        }
   }

   function insertCenteredText($image, $textParams, $addX, $addY, $color, $font){
       //print_r("insertCenteredText(". print_r(Array($image, $textParams, $addX, $addY, $color, $font), true) .")<br />");
       //echo print_r("X: " . ($textParams->centerPosition[0] +  $addX) . "; Y:" . ($textParams->centerPosition[1] + $addY). "<br />", true);
       imagettftext($image, $textParams->fontSize, 0, $textParams->centerPosition[0] +  $addX, $textParams->centerPosition[1] + $addY, $color, $font, $textParams->text);
   }

   function insertLogo($image, $logo_src, $x, $y){
       $logo = $this->load($logo_src);
       imagecopy($image, $logo, $x, $y - imagesy($logo), 0, 0, imagesx($logo), imagesy($logo));
   }

   function createBlankImage($w, $h, $r, $g, $b){
       $image = imagecreatetruecolor($w, $h);
       imagealphablending($image, true);
       imagesavealpha($image, true);
       $color = imagecolorallocate($image, $r, $g, $b);
       imagefill($image, 0, 0, $color);

       return $image;
   }

   function insertBorder($image, $borderWidth){

       $imagew = imagesx($image);
       $imageh = imagesy($image);

       $newImage = $this->createBlankImage($imagew + $borderWidth*2, $imageh + $borderWidth*2, 14, 78, 102);

       imagecopy($newImage, $image, $borderWidth, $borderWidth, 0, 0, $imagew, $imageh);

       return $newImage;
   }

   function createFacebookPostImage($text){

       $this->image = imagecreatetruecolor(250, 250);

       $fontColor = imagecolorallocate($this->image, 0, 0, 0);
       $background = imagecolorallocate($this->image, 255, 255, 255);

        imagefill($this->image, 0, 0, $background);

       $maxTextBoxHeight =  240;
       $maxTextBoxWidth = 240;

       $textParams = $this->fittTextToIamage($text, self::FONT_PATH, $maxTextBoxHeight, $maxTextBoxWidth) ;

       if($textParams == null){
           return false;
       }

       $position = $this->getCenterStartPosition($textParams->box, Array($maxTextBoxWidth, $maxTextBoxHeight));
       imagettftext($this->image, $textParams->fontSize, 0, 10, 40, $fontColor, self::FONT_PATH, $textParams->text);

       header('Content-Type: image/png');
       imagepng($this->image);
       imagedestroy($this->image);

   }

   public function sampleImage($text){
        $im = imagecreatetruecolor(120, 20);
        $text_color = imagecolorallocate($im, 233, 14, 91);
        imagestring($im, 1, 5, 5,  $text, $text_color);

        header('Content-Type: image/jpeg');

        imagejpeg($im);

        imagedestroy($im);
   }

   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         return imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         return imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         return imagecreatefrompng($filename);
      }

      return null;
   }

   function loadToCurrent($filename){
       $this->image = $this->load($filename);
   }

   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
       return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }

   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }

   function resizeImageToWidth($image, $width){
      $ratio = $width / imagesx($image);
      $height = imagesy($image) * $ratio;
      return $this->resizeImage($image, $width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }

   function resizeImage($image, $width, $height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
      return $new_image;
   }

   function getLogoImage(){
        $image = imagecreatefrompng(self::BORDER_PATH);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        $color = imagecolorallocate($image, 255, 255, 255);
        imagecolortransparent($image, $color);
        return $image;
   }

   function fittTextToIamage($text, $font, $maxTextBoxHeight, $maxTextBoxWidth) {
    //print_r("fittTextToIamage(". print_r(Array($text, $font, $maxTextBoxHeight, $maxTextBoxWidth), true) .")<br />");
       for($size = self::FONT_SIZE_MAX; $size > self::FONT_SIZE_MIN; $size--){
   //        print_r("--------------</br>");
   //       print_r("Font size = " . $size ."</br>");
           $lineLength = $this->getNumberOfCharsInLine($text, $font, $size, $maxTextBoxWidth);
   //        print_r("\tString length = " . $lineLength ."</br>");
           if($lineLength == null){
               continue;
           }
           $wrapedText = wordwrap($text, $lineLength);
           $box = imagettfbbox($size, 0, $font, $wrapedText);
           $boxHeight = $box[1] - $box[7];
   //        print_r("\tText box height = " . $boxHeight ."</br>");
           if($boxHeight <= $maxTextBoxHeight){
               $position = $this->getCenterStartPosition($box, Array($maxTextBoxWidth, $maxTextBoxHeight));
               return new ImageTextParameters($box, $wrapedText, $size, $position);
           }
       }

       return null;

   }

   function getNumberOfCharsInLine($text, $font, $fontSize, $maxTextBoxWidth){
       //print_r("getNumberOfCharsInLine(". print_r(Array($text, $font, $fontSize, $maxTextBoxWidth), true) .")<br />");
       for($length = strlen($text); $length >= self::MIN_CHARS_IN_LINE; $length = $length - self::MIN_CHARS_IN_LINE){
            //print_r("Length = " . $length . "</br>");
            $box = imagettfbbox($fontSize, 0, $font, wordwrap($text, $length));
            //print_r("---Box---</br>");
            //var_dump($box);
            //print_r("---Box---</br>");
            $boxWidth = $box[2] - $box[0];
            //print_r("Text box width = " . $boxWidth . "</br>");
            if($boxWidth <= $maxTextBoxWidth){
                return $length;
            }
       }
       return null;
   }

   function getHalf($x1, $x2){
    
       $sub = abs($x2 - $x1);

       return floor($sub / 2);
   }

   function getCenterStartPosition($box, $dimension){
       //print_r("getCenterStartPosition(". print_r(Array( $dimension), true) .")<br />");
       //var_dump($box);
       $boxHalfWidth = $this->getHalf($box[0], $box[2]);
       $imageHalfWidth =  floor($dimension[0] / 2);
       $x = $imageHalfWidth - $boxHalfWidth;
       //print_r(Array('$boxHalfWidth' => $boxHalfWidth, '$imageHalfWidth'  => $imageHalfWidth));
       $boxHalfHeight = $this->getHalf($box[7], $box[1]);
       $imageHalfHeight = floor($dimension[1] / 2);
       //print_r(Array('$boxHalfHeight' => $boxHalfHeight, '$imageHalfHeight'  => $imageHalfHeight));
       $y =  $imageHalfHeight - $boxHalfHeight;
       //print_r(Array($x,$y));
       return(Array($x,$y));
   }

}

class ImageTextParameters{
    var $box;
    var $text;
    var $fontSize;
    var $centerPosition;

    public function __construct($box, $text, $fontSize, $center) {
        $this->box = $box;
        $this->text = $text;
        $this->fontSize = $fontSize;
        $this->centerPosition = $center;

    }

}

?>
