<?php
function ads_based_on_user(): string
{
    $galaksion = 'g';//code of galaksion
    $clickendu = 'c';
    $adsterra = 'a';
    $affiliate1 = 't';
    $fallback_code = 'd';//this code will be used when all the above has been used
    $count = 0; //will use it to figure out if none of above advertiser were present use propoller or any advertiser which count huge
    $final_code = '';

    $ads_codes_dictionary = ['galaksion' => $galaksion, 'clickendu' => $clickendu, '$adsterra' => $adsterra, 'affiliate1' => $affiliate1];
    $all_advertiser_ = array_keys($ads_codes_dictionary);

    $cookie_frm_site_key_list = array_keys($_COOKIE);
    foreach ($all_advertiser_ as $key) {
        if (!in_array($key, $cookie_frm_site_key_list)) {
            $count = $count + 1;
            setcookie($key, 'ads_code_test', time() + 3600 * 24); // basically this logic means we are adding cookie an setting expire to 24 hours
            $final_code = $ads_codes_dictionary[$key];
            echo $count;
            break;
        }
    }
    if ($count < 1) {
        $final_code = $fallback_code;
    }
    return $final_code;
}
?>
