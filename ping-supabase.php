<?php
// Configuration avec tes identifiants Supabase
$supabase_url = "https://oyiiwzbmmsewjwrzjfpd.supabase.co/rest/v1/";
$supabase_key = "sb_publishable_uJnDx-se2jUqGkht6_Rh2A_Vcfddy8D";

// Initialisation de la requête vers Supabase
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $supabase_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Désactiver la vérification SSL si InfinityFree bloque la requête sortante
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "apikey: " . $supabase_key,
    "Authorization: Bearer " . $supabase_key
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Message de confirmation pour le Cron Job
if ($http_code == 200 || $http_code == 204) {
    echo "Succès : Signal envoyé ! Supabase est bien éveillé (Code $http_code).";
} else {
    echo "Erreur : Supabase a répondu avec le code $http_code. Réponse : " . $response;
}
?>