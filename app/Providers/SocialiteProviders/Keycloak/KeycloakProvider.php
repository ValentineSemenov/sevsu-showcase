<?php

namespace App\Providers\SocialiteProviders\Keycloak;

use GuzzleHttp\RequestOptions;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class KeycloakProvider extends AbstractProvider
{
    const IDENTIFIER = 'KEYCLOAK';

    /**
     * {@inheritdoc}
     */
    protected $scopes = ['openid'];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://auth.sevsu.ru/realms/portal/protocol/openid-connect/auth', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://auth.sevsu.ru/realms/portal/protocol/openid-connect/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $userUrl = 'https://auth.sevsu.ru/realms/portal/protocol/openid-connect/userinfo';

        $response = $this->getHttpClient()->get($userUrl, [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['mapping_id'],
            'first_name' => $user['first_name'],
            'second_name' => $user['family_name'],
            'last_name' => $user['middle_name'],
            'group' => $user['syncable_cohorts'],
        ]);
    }
}
