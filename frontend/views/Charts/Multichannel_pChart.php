<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 9/16/17
 * Time: 1:17 PM
 */
/* pChart library inclusions */
/* pChart library inclusions */
include("../../reception/vendor/pChart2.1.4/class/pData.class.php");
include("../../reception/vendor/pChart2.1.4//class/pDraw.class.php");
include("../../reception/vendor/pChart2.1.4//class/pImage.class.php");

/* Create the pData object with some random values*/
$MyData = new pData();

$MyData->addPoints($y,"Multichannel");
$MyData->addPoints($y,"Volume");
$MyData->setAbscissa("Volume of booking");

/* Create the pChart object */
$myPicture = new pImage(700,230,$MyData);
$myPicture->setFontProperties(["FontName"=>"/Library/Fonts/tahoma.ttf","FontSize"=>6]);

/* Create a solid background */
$Settings = array("R"=>179, "G"=>217, "B"=>91, "Dash"=>1, "DashR"=>199, "DashG"=>237, "DashB"=>111);
$myPicture->drawFilledRectangle(0,0,700,230,$Settings);

/* Do a gradient overlay */
$Settings = array("StartR"=>194, "StartG"=>231, "StartB"=>44, "EndR"=>43, "EndG"=>107, "EndB"=>58, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

/* Write the picture title */
$myPicture->setFontProperties(array("FontName"=>"/Library/Fonts/tahoma.ttf","FontSize"=>6));
$myPicture->drawText(10,13,"Chart title",array("R"=>255,"G"=>255,"B"=>255));

/* Draw the scale */
$myPicture->setFontProperties(array("FontName"=>"/Library/Fonts/tahoma.ttf","FontSize"=>11));
$myPicture->setGraphArea(50,60,670,190);
$myPicture->drawFilledRectangle(50,60,670,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
$myPicture->drawScale(array("CycleBackground"=>TRUE));

/* Graph title */
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->drawText(50,52,"Chart subtitle",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

/* Draw the bar chart chart */
$myPicture->setFontProperties(array("FontName"=>"/Library/Fonts/tahoma.ttf","FontSize"=>6));
$MyData->setSerieDrawable("Multichannel",FALSE);
$myPicture->drawBarChart();

/* Draw the line and plot chart */
$MyData->setSerieDrawable("Multichannel",TRUE);
$MyData->setSerieDrawable("Volume",FALSE);
$myPicture->drawSplineChart();
$myPicture->drawPlotChart();

/* Make sure all series are drawable before writing the scale */
$MyData->setSerieDrawable("Multichannel",TRUE);

/* Write the legend */
$myPicture->drawLegend(540,35,array("Style"=>LEGEND_ROUND,"Alpha"=>20,"Mode"=>LEGEND_HORIZONTAL));

/* Render the picture (choose the best way) */
$myPicture->autoOutput("pictures/example.combo.png");
?>