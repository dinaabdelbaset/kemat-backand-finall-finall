<?php

$brain1 = 'C:/Users/Technologist/.gemini/antigravity/brain/66fb5c08-f331-460b-90d0-ebc614abb105/';
$brain2 = 'C:/Users/Technologist/.gemini/antigravity/brain/c2d84a60-43f5-453b-b555-f79cac85e55b/';
$destDir = __DIR__ . '/storage/app/kamet-images/';

if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

$map = [
    'pyramids' => 'event_pyramids_light_show_1775182379397.png',
    'dervishes' => 'event_whirling_dervishes_1775182399411.png',
    'opera' => 'event_opera_aida_1775182414340.png',
    'jazz' => 'event_cairo_jazz_1775182429105.png',
    'edm' => 'event_red_sea_edm_1775182448774.png',
    'book' => 'event_book_fair_1775182462625.png',
    'hero' => 'event_hero_banner_1775182476585.png',
    // Museums & Temples
    'lm_gem' => 'landmark_gem_1775215583436.png',
    'lm_nmec' => 'landmark_nmec_1775215601100.png',
    'lm_karnak' => 'landmark_karnak_1775215616996.png',
    'lm_luxor_museum' => 'landmark_luxor_museum_1775215631124.png',
    'lm_abu_simbel' => 'landmark_abu_simbel_1775215644446.png',
    'lm_philae' => 'landmark_philae_1775215667181.png',
    'lm_graeco_roman' => 'landmark_graeco_roman_1775215682490.png',
    'lm_qaitbay' => 'landmark_qaitbay_1775215696511.png',
    'lm_hurghada_museum' => 'landmark_hurghada_museum_1775215710824.png',
    'lm_sharm' => 'landmark_sharm_1775215753098.png',
    'lm_hero' => 'landmark_museums_hero_1775215725809.png',
    // Bazaars
    'baz_cairo' => 'bazaar_cairo_1775219962844.png',
    'baz_aswan' => 'bazaar_aswan_1775219976751.png',
    'baz_luxor' => 'bazaar_luxor_1775219992038.png',
    'baz_sharm' => 'bazaar_sharm_1775220006973.png',
    'baz_alexandria' => 'bazaar_alexandria_1775220029745.png',
    'baz_siwa' => 'bazaar_siwa_1775220046473.png',
    'baz_hurghada' => 'bazaar_hurghada_1775220061416.png',
    'baz_dahab' => 'bazaar_dahab_1775220078315.png',
    // Destinations
    'dest_cairo' => 'dest_cairo_1775223865548.png',
    'dest_luxor' => 'dest_luxor_1775223881542.png',
    'dest_aswan' => 'dest_aswan_1775223897924.png',
    'dest_sharm' => 'dest_sharm_1775223914300.png',
    'dest_hurghada' => 'dest_hurghada_1775223938243.png',
    'dest_alexandria' => 'dest_alexandria_1775223954054.png',
    'dest_marsa_alam' => 'dest_marsa_alam_1775223972577.png',
    'dest_dahab' => 'dest_dahab_1775223990256.png',
    // Fallbacks for ExplorePage
    'food_1' => 'food_koshary_1775171500798.png',
    'food_2' => 'food_fatta_1775168550864.png',
    'safari_1' => 'desert_safari_atv_tour_1775071172281.png',
    'safari_2' => 'red_sea_snorkeling_tour_1775071131863.png',
    'hotel_fallback' => 'hotel_cairo_boutique_1775166750685.png',
    'base_cairo_mosque' => 'islamic_egypt_cairo_1775066959857.png', // Added fallback
    // Shop products
    'shop_papyrus' => 'shop_papyrus_1775236738734.png',
    'shop_nefertiti' => 'shop_nefertiti_1775236758817.png',
    'shop_tut_mask' => 'shop_tut_mask_1775236775264.png',
    'shop_cartouche' => 'shop_cartouche_1775236789704.png',
    'shop_scarf' => 'shop_scarf_1775236808882.png',
    'shop_nubian_basket' => 'shop_nubian_basket_1775236828632.png',
    'shop_anubis' => 'shop_anubis_1775236842955.png',
    'shop_spice_box' => 'shop_spice_box_1775236859610.png',
    // Nile Cruise Deal
    'deal_nile_deck' => 'nile_dinner_deck_1775240334351.png',
    'deal_nile_buffet' => 'nile_dinner_buffet_1775240349844.png',
    'deal_nile_show' => 'nile_dinner_show_1775240365654.png',
    // Safari Deal
    'deal_safari_bashing' => 'safari_dune_bashing_1775240536827.png',
    'deal_safari_camp' => 'safari_bedouin_camp_1775240555857.png',
    'deal_safari_lake' => 'safari_salt_lake_1775240569448.png',
    // Diving Deal
    'deal_dive_coral' => 'dive_coral_1775240720787.png',
    'deal_dive_scuba' => 'dive_scuba_1775240735742.png',
    'deal_dive_boat' => 'dive_boat_1775240749855.png',
    // Pyramids Deal
    'deal_pyramids_sunset' => 'pyramids_vip_sunset_1775240772568.png',
    'deal_pyramids_sphinx' => 'pyramids_sphinx_1775240790054.png',
    'deal_pyramids_gold' => 'pyramids_museum_gold_1775240805561.png',
    
    // Fallbacks from brain2
    'hotel_pyramids_view' => 'hotel_pyramids_view_1775156544799.png',
    'hotel_nile_view' => 'hotel_nile_view_1775156561628.png',
];

$copied = 0;
foreach ($map as $key => $filename) {
    $src1 = $brain1 . $filename;
    $src2 = $brain2 . $filename;
    $dest = $destDir . $key . '.png';
    
    if (file_exists($src1)) {
        copy($src1, $dest);
        $copied++;
    } elseif (file_exists($src2)) {
        copy($src2, $dest);
        $copied++;
    } else {
        echo "Missing: $filename\n";
    }
}

echo "Copied $copied images to $destDir\n";
