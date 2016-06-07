<?php
$user   = isset($argv[1]) ? $argv[1] : "hugojunior";
$source = @file_get_contents("https://www.instagram.com/{$user}");
preg_match_all("/<script type=\"text\/javascript\">window._sharedData = (.*?);<\/script>/ism", $source, $data);

printf("===============================================================%s", PHP_EOL);
if(isset($data[1][0]))
{
    $data = json_decode($data[1][0]);

    printf("         ID: %s%s", $data->entry_data->ProfilePage[0]->user->id, PHP_EOL);
    printf("    Usuário: %s%s", $data->entry_data->ProfilePage[0]->user->username, PHP_EOL);
    printf("       Nome: %s%s", $data->entry_data->ProfilePage[0]->user->full_name, PHP_EOL);
    printf("Publicações: %s%s", $data->entry_data->ProfilePage[0]->user->media->count, PHP_EOL);
    printf(" Seguidores: %s%s", $data->entry_data->ProfilePage[0]->user->followed_by->count, PHP_EOL);
    printf("   Seguindo: %s%s", $data->entry_data->ProfilePage[0]->user->follows->count, PHP_EOL);
} else
{
    printf("✖ Não foi possível recuperar as informações do usuário: %s%s", $user, PHP_EOL);
}
printf("===============================================================%s", PHP_EOL);
