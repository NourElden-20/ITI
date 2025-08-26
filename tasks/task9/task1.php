<?PHP
$array=[
    'php',
    'open source',
    'ITI',
    'Day2',
    ['ali','nour','baher']
];

foreach($array as $value){
    echo'<pre>';
    print_r( $value);
    echo'<pre>';
}
echo "<hr>";

$info=[
'name'=>'nour',
'age'=>21,
'email'=>'n@gmail.com',
'collage'=>'CIC'
];



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show data</title>
</head>
<body>
   <table style="border: 3px black solid;">
    <tr>
        <th style="border: 1px solid black; padding: 8px;">1</th>
        <th style="border: 1px solid black; padding: 8px;">2</th>
    </tr>
    <?php foreach ($info as $x => $y) { ?>
        <tr>
            <td style="border: 1px solid black; padding: 8px;"><?php echo $x; ?></td>
            <td style="border: 1px solid black; padding: 8px;"><?php echo $y; ?></td>
        </tr>
    <?php } ?>
</table>


</body>
</html>

<?php
sort($info);
print_r($info);

ksort($info);
 
print_r(array_keys($info));


?>