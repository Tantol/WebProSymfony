<?php

namespace TradeBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use TradeBundle\Entity\Product;
use AppBundle\Entity\User;

class ProductVoter extends Voter {
    
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';
    
    protected function supports($attribute, $subject) {
        
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::DELETE])){
            return false;
        }
        
        if (!$subject instanceof Product){
            return false;
        }
        
        return true; 
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        
        $user = $token->getUser();
        
        // Check if the user is logged in
        if (!$user instanceof User){
            return false;
        }
        
        // Check if the user is the actual ovner of the product
        if ($subject->getUser() !== $user){
            return false;
        }
        return true;
    }

}

