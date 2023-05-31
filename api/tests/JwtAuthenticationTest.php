<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class JwtAuthenticationTest extends ApiTestCase
{
    public function testLogin(): void
    {
        $client    = self::createClient();
        $container = self::getContainer();

        $user = new User();
        $user->setUsername('test_user');
        $user->setPassword(
            $container->get('security.user_password_hasher')->hashPassword($user, '$3CR3T')
        );

        $manager = $container->get('doctrine')->getManager();
        $manager->persist($user);
        $manager->flush();

        // retrieve a token
        $response = $client->request('POST', '/api/login_check', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => [
                'email'    => 'test_user',
                'password' => '$3CR3T',
            ],
        ]);

        $json = $response->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $json);

        // test not authorized
        $client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(401);

        // test authorized
        $client->request('GET', '/users', ['auth_bearer' => $json['token']]);
        $this->assertResponseIsSuccessful();
    }
}
