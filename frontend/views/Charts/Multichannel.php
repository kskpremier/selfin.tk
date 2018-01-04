
<div class="col-sm-5">
    <?php
    use scotthuangzl\googlechart\GoogleChart;

// X,Y
    $data[] = [$legend["AxisX"],$legend["AxisY"]];
    foreach ($x as $key=>$ValueX){
        $data[]=[$ValueX,$y[$key]];
    }
    echo GoogleChart::widget(array('visualization' => 'LineChart', 'data'=>$data,
        'options' => [
                'title' => $legend["Title"],
            'width' => 600,
            'height' => 400,
            'hAxis' => array('title' => $legend['AxisX']),
            'vAxis' => array('title' => $legend['AxisY']),
            'legend'=>'bottom',
        ])); ?>

</div>