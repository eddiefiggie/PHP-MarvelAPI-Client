<?php
function credential() {
    $timeStamp = time();
    $publicKey = 'YOUR KEY HERE';
    $privateKey = 'YOUR KEY HERE';
    $hashable = $timeStamp.$privateKey.$publicKey;
    $hash = md5($hashable);
    $credentialAppend = '&ts='.$timeStamp.'&apikey='.$publicKey.'&hash='.$hash;
    return $credentialAppend;
}

function dataBuilder($hero) {
    $append = credential();
    $marvel_url = 'https://gateway.marvel.com/v1/public/characters?name='.$hero.$append;
    echo "$marvel_url";
    $hero_jason =  file_get_contents($marvel_url);
    $hero_data = json_decode($hero_jason, true);
    return $hero_data;
}

function heroImage ($hero_data) {
    $thumbnail = $hero_data['data']['results'][0]['thumbnail']['path'].".jpg";
    return $thumbnail;
}

function heroDescription($hero_data) {
    $description = $hero_data['data']['results'][0]['description'];
    return $description;
}

function heroQtyComics($hero_data) {
    $qtyComics = $hero_data['data']['results'][0]['comics']['available'];
    return $qtyComics;
}

function attributionHTML($hero_data) {
    $attribHTML = $hero_data['attributionHTML'];
    return $attribHTML;
}

function attributionText($hero_data) {
    $attributionText = $hero_data['attributionText'];
    return $attributionText;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Marvel Hero Search</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <nav>
        <form action="index.php" method="get">
            <input type="text" name="hero" placeholder="hero name">
            <button type="submit" name="submit">Submit</button>
        </form>
    </nav>

    <main>
        <?php
            if(isset($_GET['hero'])) {
                $api_data = dataBuilder($_GET['hero']);
                $hero_img = heroImage($api_data);
                $hero_desc = heroDescription($api_data);
                $atHTML = attributionHTML($api_data);
                $qty = heroQtyComics($api_data);

                echo "<p><img src=\"$hero_img\" alt=\"Image\"></p><br>";
                echo "<p>$hero_desc</p><br>";
                echo "<p>Volume of comic book appearances: $qty</p><br>";
                echo "<p>$atHTML</p><br>";


            }
        ?>
    </main>

</body>
</html>