<?php
/**
 *    This file is part of OXID eShop Community Edition.
 *
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @package   core
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: oxutilspic.php 32881 2011-02-03 11:45:36Z sarunas $
 */

// checks if GD library version getter does not exist
if ( !function_exists( "getGdVersion" ) ) {
    /**
     * Returns GD library version
     *
     * @return int
     */
    function getGdVersion()
    {
        return oxConfig::getInstance()->getConfigParam( 'iUseGDVersion' );
    }
}

// checks if image creation function does not exist
if ( !function_exists( "copyAlteredImage" ) ) {
    /**
     * Creates and copies the resized image
     *
     * @param string $sDestinationImage file + path of destination
     * @param string $sSourceImage      file + path of source
     * @param int    $iNewWidth         new width of the image
     * @param int    $iNewHeight        new height of the image
     * @param array  $aImageInfo        additional info
     * @param string $sTarget           target file path
     * @param int    $iGdVer            used gd version
     *
     * @return bool
     */
    function copyAlteredImage( $sDestinationImage, $sSourceImage, $iNewWidth, $iNewHeight, $aImageInfo, $sTarget, $iGdVer )
    {
        if ( $iGdVer == 1 ) {
            $blSuccess = imagecopyresized( $sDestinationImage, $sSourceImage, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $aImageInfo[0], $aImageInfo[1] );
        } else {
            $blSuccess = imagecopyresampled( $sDestinationImage, $sSourceImage, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $aImageInfo[0], $aImageInfo[1] );
        }

        return $blSuccess;
    }
}

// checks if image size calculator does nor exist
if ( !function_exists( "calcImageSize" ) ) {
    /**
     * Calculates proportional new image size
     *
     * @param int $iDesiredWidth  expected image width
     * @param int $iDesiredHeight expected image height
     * @param int $iPrefWidth     original image width
     * @param int $iPrefHeight    original image height
     *
     * @return array
     */
    function calcImageSize( $iDesiredWidth, $iDesiredHeight, $iPrefWidth, $iPrefHeight )
    {
        // #1837/1177M - do not resize smaller pictures
        if ( $iDesiredWidth < $iPrefWidth || $iDesiredHeight < $iPrefHeight ) {
            if ( $iPrefWidth >= $iPrefHeight * ( (float) ( $iDesiredWidth / $iDesiredHeight ) ) ) {
                $iNewHeight = round( ( $iPrefHeight * (float) ( $iDesiredWidth / $iPrefWidth ) ), 0 );
                $iNewWidth  = $iDesiredWidth;
            } else {
                $iNewHeight = $iDesiredHeight;
                $iNewWidth  = round( ( $iPrefWidth * (float) ( $iDesiredHeight / $iPrefHeight ) ), 0 );
            }
        } else {
            $iNewWidth  = $iPrefWidth;
            $iNewHeight = $iPrefHeight;
        }

        return array( $iNewWidth, $iNewHeight );
    }
}

// checks if GIF resizer does not exist
if ( !function_exists( "resizeGif" ) ) {
    /**
     * Creates resized GIF image. Returns path of new file if creation
     * succeded. On error returns FALSE
     *
     * @param string $sSrc            GIF source
     * @param string $sTarget         new image location
     * @param int    $iNewWidth       new width
     * @param int    $iNewHeight      new height
     * @param int    $iOriginalWidth  original width
     * @param int    $iOriginalHeigth original heigth
     * @param int    $iGDVer          GD library version
     *
     * @return string | false
     */
    function resizeGif( $sSrc, $sTarget, $iNewWidth, $iNewHeight, $iOriginalWidth, $iOriginalHeigth, $iGDVer )
    {
        $hDestinationImage = imagecreate( $iNewWidth, $iNewHeight );
        $hSourceImage = imagecreatefromgif( $sSrc );
        $iTransparentColor = imagecolorresolve( $hSourceImage, 255, 255, 255 );
        $iFillColor = imagecolorresolve( $hDestinationImage, 255, 255, 255 );
        imagefill( $hDestinationImage, 0, 0, $iFillColor );
        imagecolortransparent( $hSourceImage, $iTransparentColor );

        if ( $iGDVer == 1 ) {
            imagecopyresized( $hDestinationImage, $hSourceImage, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $iOriginalWidth, $iOriginalHeigth );
        } else {
            imagecopyresampled( $hDestinationImage, $hSourceImage, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $iOriginalWidth, $iOriginalHeigth );
        }

        imagecolortransparent( $hDestinationImage, $fillColor );
        imagegif( $hDestinationImage, $sTarget );
        imagedestroy( $hDestinationImage );
        imagedestroy( $hSourceImage );
        return $sTarget;
    }
}

// checks if PNG resizer does not exist
if ( !function_exists( "resizePng" ) ) {
    /**
     * Creates resized PNG image. Returns path of new file if creation
     * succeded. On error returns FALSE
     *
     * @param string   $sSrc              JPG source
     * @param string   $sTarget           new image location
     * @param int      $iWidth            new width
     * @param int      $iHeight           new height
     * @param int      $aImageInfo        original width
     * @param int      $iGdVer            GD library version
     * @param resource $hDestinationImage destination image handle
     *
     * @return string | false
     */
    function resizePng( $sSrc, $sTarget, $iWidth, $iHeight, $aImageInfo, $iGdVer, $hDestinationImage )
    {
        if ( $hDestinationImage === null ) {
            $hDestinationImage = $iGdVer == 1 ? imagecreate( $iWidth, $iHeight ) : imagecreatetruecolor( $iWidth, $iHeight );
        }

        $blSuccess = false;
        $hSourceImage = imagecreatefrompng( $sSrc );

        if ( !imageistruecolor( $hSourceImage ) ) {
            $hDestinationImage = imagecreate( $iWidth, $iHeight );
            // fix for transparent images sets image to transparent
            $imgWhite = imagecolorallocate( $hDestinationImage, 255, 255, 255 );
            imagefill( $hDestinationImage, 0, 0, $imgWhite );
            imagecolortransparent( $hDestinationImage, $imgWhite );
            //end of fix
        } else {
            imagealphablending( $hDestinationImage, false );
            imagesavealpha( $hDestinationImage, true );
        }

        if ( copyAlteredImage( $hDestinationImage, $hSourceImage, $iWidth, $iHeight, $aImageInfo, $sTarget, $iGdVer ) ) {
            imagepng( $hDestinationImage, $sTarget );
            imagedestroy( $hDestinationImage );
            imagedestroy( $hSourceImage );
            $blSuccess = $sTarget;
        }

        return $blSuccess;
    }
}

// checks if JPG resizer does not exist
if ( !function_exists( "resizeJpeg" ) ) {
    /**
     * Creates resized JPG image. Returns path of new file if creation
     * succeded. On error returns FALSE
     *
     * @param string   $sSrc              JPG source
     * @param string   $sTarget           new image location
     * @param int      $iWidth            new width
     * @param int      $iHeight           new height
     * @param int      $aImageInfo        original width
     * @param int      $iGdVer            GD library version
     * @param resource $hDestinationImage destination image handle
     * @param int      $iDefQuality       new image quality
     *
     * @return string | false
     */
    function resizeJpeg( $sSrc, $sTarget, $iWidth, $iHeight, $aImageInfo, $iGdVer, $hDestinationImage, $iDefQuality )
    {
        if ( $hDestinationImage === null ) {
            $hDestinationImage = $iGdVer == 1 ? imagecreate( $iWidth, $iHeight ) : imagecreatetruecolor( $iWidth, $iHeight );
        }

        $blSuccess = false;
        $hSourceImage = imagecreatefromjpeg( $sSrc );
        if ( copyAlteredImage( $hDestinationImage, $hSourceImage, $iWidth, $iHeight, $aImageInfo, $sTarget, $iGdVer ) ) {
            imagejpeg( $hDestinationImage, $sTarget, $iDefQuality );
            imagedestroy( $hDestinationImage );
            imagedestroy( $hSourceImage );
            $blSuccess = $sTarget;
        }

        return $blSuccess;
    }
}