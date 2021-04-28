<?php

namespace App\Domain\Auth\Service;

use App\Domain\Auth\Repository\BasicAuthRepository;

/**
 * Service.
 */
final class BasicAuthValidation
{
    /**
     * @var BasicAuthRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param BasicAuthRepository $repository The repository
     */
    public function __construct(BasicAuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Validate the token
     * 
     * Decode token has this format : username:****** password:******
     *
     * @param string $token base64 encoded token
     *
     * @return bool true if the token is valid
     */
    public function isTokenValid(string $token): bool
    {
        // Decode the token to a string
        $decodedToken = base64_decode($token);
        // Split the decode token in two part and keep only username and password value.
        $tokenDa = explode(' ', $decodedToken)[0] ?? '';
        $tokenHashedDa = explode(' ', $decodedToken)[1] ?? '';
        // Find the password stored in the BD for the username
        //$hashedDa = $this->repository->selectHashedDa($da);
        // Verify that the two password are identical
        return password_verify($tokenDa, $tokenHashedDa);
    }
}
