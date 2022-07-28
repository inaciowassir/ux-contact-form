<?php

namespace sprint\ssecurity;

use sprint\ssession\SSession;
use sprint\srequest\SRequest;

class SSecurity
{    
    // Generate a token for use with CSRF protection.
    // Does not store the token.
    private static function csrfToken() 
    {
        return md5(uniqid(rand(), TRUE));
    }

    // Generate and store CSRF token in user session.
    public static function createCsrfToken() 
    {        
        $token = $this->csrfToken();
        
        SSession::set('csrfToken', $token);
        
        SSession::set('csrfTokenTime', time());
        
        return $token;
    }

    // Destroys a token by removing it from the session.
    public static function destroyCsrfToken() 
    {
        SSession::unset(["csrfToken", "csrfTokenTime"]);
        
        return true;
    }

    // Return an HTML tag including the CSRF token 
    // for use in a form.
    // Usage: echo SSecurity::createCsrfToken();
    public static function csrfTokenTag() 
    {
        $token = self::createCsrfToken();
        
        return "<input type=\"hidden\" name=\"csrfToken\" value=\"".$token."\">";
    }

    // Returns true if user-submitted POST token is
    // identical to the previously stored SESSION token.
    // Returns false otherwise.
    public function isValidCsrfToken() 
    {
        $post = Request::body();
        
        if(isset($post['csrfToken'])) 
        {
            $userToken      = $post["csrfToken"];
            
            $storedToken    = SSession::get("csrfToken");
            
            return $userToken === $storedToken;
        } else 
        {
            return false;
        }
    }

    // You can simply check the token validity and 
    // handle the failure yourself, or you can use 
    // this "stop-everything-on-failure" function. 
    public static function invalidCsrfToken() 
    {
        if(!self::isValidCsrfToken()) 
        {
            return throw new \Exception("You provided invalid token.");
        }
    }

    // Optional check to see if token is also recent
    public static function isRecentCsrfToken() 
    {
        $maxElapsed = 60 * 60 * 24; // 1 day
        
        $storedTime = SSession::get("csrfTokenTime");
        
        if(!empty($storedTime)) 
        {
            return ($storedTime + $maxElapsed) >= time();
        } else 
        {
            // Remove expired token
            self::destroyCsrfToken();
        
            return false;
        }
    }

    // check if the request was done with same domain
    public static function isSameDomain() 
    {
        if(empty(Request::refer())) 
        {
            // No refererer sent, so can't be same domain
            throw new \Exception("No refererer sent, so can't be same domain.");
        } else 
        {
            // is same domain returns true or thrown an exception
            return (Request::referHost() == Request::host()) ? true : throw new \Exception("No refererer sent, so can't be same domain.");
        }
    }

}