<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 06.01.18
 * Time: 16:06
 */

namespace App\Security;


use App\Entity\RunDiary;
use App\Entity\UserData;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class DiaryVoter extends Voter {
    const DELETE = 'delete';

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        // TODO: Implement supports() method.
        return $subject instanceof RunDiary && in_array($attribute, [self::DELETE], true);
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // TODO: Implement voteOnAttribute() method.
        $user = $token->getUser();

        if(!$user instanceof UserData){
            return false;
        }

        return $token->getUser() === $subject->getOwner();
    }
}