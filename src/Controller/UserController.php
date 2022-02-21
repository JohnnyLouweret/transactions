<?php

namespace App\Controller;

use App\Entity\User;
use App\Utility\UserUtility;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @var UserUtility
     */
    private $userUtility;

    /**
     * @param UserUtility         $userUtility
     */
    public function __construct(
        UserUtility $userUtility
    ) {
        $this->userUtility = $userUtility;
    }

    /**
     * @Route("/user/austria")
     *
     * @return Response
     * @throws Exception
     */
    public function showActiveUsersFromAustria(): Response
    {
        $userCollection = $this->userUtility->getActiveUsersFromAustria();

        return $this->json($userCollection->toArray());
    }

    /**
     * @Route("/user/{user}/detail", methods={"PATCH"})
     *
     * @param Request   $request
     * @param User|null $user
     *
     * @return Response
     */
    public function edit(Request $request, User $user = null): Response
    {
        if (is_null($user)) {
            return new Response('User not found.', 404);
        }

        if (is_null($user->getDetails())) {
            return new Response('Cannot edit User without User details.', 400);
        }

        $userDetail = $this->userUtility->updateUserDetailsFromRequest($user->getDetails(), $request);

        return $this->json($userDetail->toArray());
    }

    /**
     * @Route("/user/{user}")
     *
     * @param User|null $user
     *
     * @return Response
     * @throws Exception
     */
    public function delete(User $user = null): Response
    {
        if (is_null($user)) {
            return new Response('User not found.', 404);
        }

        if (is_null($user->getDetails())) {
            return new Response('Cannot delete a user who already has user details.', 400);
        }

        $this->userUtility->delete($user);

        return new Response(null, 204);
    }
}
