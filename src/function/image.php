<?php

function getImage($idrace) : string
{
    switch ($idrace) {
        case (1):
            return "images/pythonCrop.png";
        case (2):
            return "images/cobraCrop.png";
        case (3):
            return "images/vipereCrop.png";
        case (4):
            return "images/anacondaCrop.png";
        case (5):
            return "images/boaCrop.png";
        default :
            return "";
    }
}

function getBigImage($idrace) : string
{
    switch ($idrace) {
        case (1):
            return "images/python.png";
        case (2):
            return "images/cobra.png";
        case (3):
            return "images/vipere.png";
        case (4):
            return "images/anaconda.png";
        case (5):
            return "images/boa.png";
        default :
            return "";
    }
}
