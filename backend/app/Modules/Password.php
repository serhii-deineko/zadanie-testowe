<?php

namespace App\Modules;

class Password
{
    public string $error = '';
    protected object $user;

    public function verifyPassword(String $password): bool
    {
        $characters = [
            'logic' => 7,
            'required' => true,];
        $upperCase = [
            'logic' => preg_match('@[A-Z]@', $password), 
            'required' => false];
        $lowerCase = [
            'logic' => preg_match('@[a-z]@', $password),
            'required' => true];
        $oneNumber = [
            'logic' => preg_match('@[0-9]@', $password),
            'required' => true];
        $specialChars = [
            'logic' => preg_match('@[^\w]@', $password),
            'required' => false];

        return $this->checkPassword(
            $characters, 
            $upperCase, 
            $lowerCase, 
            $oneNumber, 
            $specialChars, 
            $password, 
        );
    }

    private function checkPassword($characters, $upperCase, $lowerCase, $oneNumber, $specialChars, string $password) {
        if((strlen($password) < $characters['logic']) && ($characters['required'])) {
            $this->error = 'Password needs at least ' . $characters['logic'] . ' Characters';
            return false;
        } 
        elseif(!$upperCase['logic'] && $upperCase['required']) {
            $this->error = 'Password needs at least one Upper-Case letter';
            return false;
        } 
        elseif(!$lowerCase['logic'] && $lowerCase['required']) {
            $this->error = 'Password needs at least one Lower-Case letter';
            return false;
        } 
        elseif(!$oneNumber['logic'] && $oneNumber['required']) {
            $this->error = 'Password needs at least one Number';
            return false;
        } 
        elseif(!$specialChars['logic'] && $specialChars['required']) {
            $this->error = 'Password needs at least one Special-Character';
            return false;
        } 
        return true;
    }
}
