<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware.Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle\OAuth\ResourceOwner;

/**
 * BoxResourceOwner
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class BoxResourceOwner extends GenericOAuth2ResourceOwner
{
    /**
     * {@inheritDoc}
     */
    protected $options = array(
        'authorization_url'   => 'https://www.box.com/api/oauth2/authorize',
        'access_token_url'    => 'https://www.box.com/api/oauth2/token',
        'revoke_token_url'    => 'https://www.box.com/api/oauth2/revoke',
        'infos_url'           => 'https://api.box.com/2.0/users/me',
    );

    /**
     * {@inheritDoc}
     */
    protected $paths = array(
        'identifier'     => 'id',
        'nickname'       => 'name',
        'realname'       => 'name',
        'email'          => 'login',
        'profilepicture' => 'avatar_url'
    );

    /**
     * {@inheritDoc}
     */
    public function revokeToken($token)
    {
        $parameters = array(
            'client_id'     => $this->getOption('client_id'),
            'client_secret' => $this->getOption('client_secret'),
            'token'         => $token
        );

        /* @var $response \Buzz\Message\Response */
        $response = $this->httpRequest($this->normalizeUrl($this->getOption('revoke_token_url')), $parameters, array(), 'POST');

        return 200 === $response->getStatusCode();
    }
}
