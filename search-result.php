<?php
function credential() {
    $timeStamp = time();
    $publicKey = 'YOUR_KEY_HERE';
    $privateKey = 'YOUR_KEY_HERE';
    $hashable = $timeStamp.$privateKey.$publicKey;
    $hash = md5($hashable);
    $credentialAppend = '&ts='.$timeStamp.'&apikey='.$publicKey.'&hash='.$hash;
    return $credentialAppend;
}
function dataBuilder($hero) {
    $append = credential();
    $marvel_url = 'https://gateway.marvel.com/v1/public/characters?name='.$hero.$append;
    //echo "$marvel_url";
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

if (isset($_GET['generalSearch'])) {
    $api_data = dataBuilder($_GET['generalSearch']);
    $hero_img = heroImage($api_data);
    $hero_desc = heroDescription($api_data);
    $atHTML = attributionHTML($api_data);
    $qty = heroQtyComics($api_data);

    require "header.php";

    echo "<main>
    <article class=\"character-summary\">
        <h2>Backstory</h2>
        <p>$hero_desc</p><br><hr><br>";

    echo "<h2>Comic Book Appearances</h2>
        <p class=\"character-appearances\">$qty</p><br><hr><br>";

    echo "<p class='character-attribution'>$atHTML</p></article>";

    echo "<aside class=\"character-portrait\"><figure>
            <img src=\"$hero_img\" alt=\"Image\" />
        </figure>
    </aside>

</main>";

    require "footer.php";

}
?>





