<?php

namespace App\Services;

/**
 * This class takes the data from user and then process it and return 
 * in the form of array.
 * 
 * @method getAccountDetails()
 *    Takes all the details that user has enter during sign up and returns
 *    in the form of array.
 * 
 * @author Deepak Pandey <deepak.pandey@innoraft.com>
 */
class NewAccountCreation {
    /**
     * Takes all the details that user has enter during sign up and returns
     * in the form of array.
     *
     * @param object $request
     *   Request object handles parameter from query parameter.
     * 
     * @return array
     *   It returns array of data that user has enter during signup.
     */
    public function getAccountDetails($request) {
        $firstName = $request->request->get('fname');
        $lastName = $request->request->get('lname');
        $gender = $request->request->get('gender');
        $image = $request->files->get('image');
        $about = $request->request->get('abotYou');
        $otpUser = $request->request->get('otp');
        $email = $request->request->get('email');
        $pass = $request->request->get('pass');
        $collegeId = ($request->request->get('collegeId')) ? $request->request->get('collegeId') : "NULL";
        $collegeName = ($request->request->get('collegeName') ? $request->request->get('collegeName') : "NULL");
        $designation = ($request->request->get('designation')) ? $request->request->get('designation') : "NULL";
        $addressInsti = ($request->request->get('addressInsti')) ? $request->request->get('addressInsti') : "NULL";
        $state = ($request->request->get('state')) ? $request->request->get('state') : "NULL";
        $city = ($request->request->get('city')) ? $request->request->get('city') : "NULL";
        $zipCode = ($request->request->get('zipCode')) ? $request->request->get('zipCode') : "NULL";
        $authLetter = ($request->files->get('authLetter')) ? $request->files->get('authLetter') : "NULL";
        $phoneNumber = $request->request->get('phoneNumber');
        $conPass = $request->request->get('confirmPass');
        $role = $request->request->get('role');

        $arr = [];
        $arr[] = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'gender' => $gender,
            'image' => $image,
            'about' => $about,
            'otpUser' => $otpUser,
            'email' => $email,
            'pass' => $pass,
            'conPass' => $conPass,
            'collegeId' => $collegeId,
            'collegeName' => $collegeName,
            'designation' => $designation,
            'addressInsti' => $addressInsti,
            'state' => $state,
            'city' => $city,
            'zipCode' => $zipCode,
            'authLetter' => $authLetter,
            'phoneNumber' => $phoneNumber,
            'role' => $role,
        ];
        return $arr[0];
    }
}
?>
