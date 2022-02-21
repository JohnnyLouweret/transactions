<?php

namespace App\Utility;

use App\Entity\User;
use App\Entity\UserDetail;
use App\Object\Collection\UserCollection;
use App\Object\Enum\CountryEnum;
use App\Repository\CountryRepository;
use App\Repository\UserDetailRepository;
use App\Repository\UsersRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class UserUtility
{
    /**
     * Exception message.
     */
    const EXCEPTION_COUNTRY_NOT_FOUND = 'Cannot find country: %s';

    /**
     * @var UsersRepository
     */
    private $userRepository;

    /**
     * @var UsersRepository
     */
    private $userDetailRepository;

    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * @param UsersRepository      $userRepository
     * @param UserDetailRepository $userDetailRepository
     * @param CountryRepository    $countryRepository
     */
    public function __construct(
        UsersRepository $userRepository,
        UserDetailRepository $userDetailRepository,
        CountryRepository $countryRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * @throws Exception
     */
    public function getActiveUsersFromAustria(): UserCollection
    {
        $country = $this->countryRepository->findOneByCountryEnum(CountryEnum::createAustria());

        if (is_null($country)) {
            throw new Exception(sprintf(
                self::EXCEPTION_COUNTRY_NOT_FOUND,
                CountryEnum::COUNTRY_AUSTRIA
            ));
        }

        return $this->userRepository->findActiveByCountry($country);
    }

    /**
     * @param User $user
     *
     * @return void
     * @throws Exception
     */
    public function delete(User $user): void
    {
        $this->assertUserHasNoDetails($user);

        $this->userRepository->delete($user);
    }

    /**
     * @param UserDetail $userDetail
     * @param Request    $request
     *
     * @return UserDetail
     */
    public function updateUserDetailsFromRequest(UserDetail $userDetail, Request $request): UserDetail
    {
        $data = json_decode($request->getContent(), true);

        if (array_key_exists(UserDetail::FIELD_API_FIRST_NAME, $data)) {
            $userDetail->setFirstName($data[UserDetail::FIELD_API_FIRST_NAME]);
        }

        if (array_key_exists(UserDetail::FIELD_API_LAST_NAME, $data)) {
            $userDetail->setLastName($data[UserDetail::FIELD_API_LAST_NAME]);
        }

        $this->userDetailRepository->save();

        return $userDetail;
    }


    /**
     * @throws Exception
     */
    private function assertUserHasNoDetails(User $user): void
    {
        if ($user->getDetails() instanceof UserDetail) {
            throw new Exception('User has UserDetails.');
        }
    }
}
