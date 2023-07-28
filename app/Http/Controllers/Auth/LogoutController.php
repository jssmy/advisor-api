<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Symfony\Component\HttpFoundation\Response;

class LogoutController extends Controller
{
    public function  logout(string $tokenId) {
        try {
            $tokenRepository = app(TokenRepository::class);
            $refreshTokenRepository = app(RefreshTokenRepository::class);


            $tokenRepository->revokeAccessToken($tokenId);
            $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);

            return response()->json([
                'status' => Response::HTTP_OK,
               'description' => 'Sessión revocada'
            ]);
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'status' => Response::HTTP_BAD_REQUEST,
                    'description' => 'Error al intentar revocar los accessos'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
