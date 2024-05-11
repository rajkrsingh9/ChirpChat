<?php

namespace App\Services;

/**
 * This class takes the object and then process it and return 
 * in the form of array.
 * 
 * @method getOnlineUser()
 *    Converts array of user data in associative array.
 * @method getCurrentPost()
 *    Converts array of all posts to current post in the form of associative array.
 * @method getAllPosts()
 *    Converts array of all posts in the form of associative array.
 * @method getComments()
 *    Converts object of all comments in the form of array.
 * 
 * @author Deepak Pandey <deepak.pandey@innoraft.com>
 */
class UserOperations {
    /**
     * Converts array of user data in associative array.
     *
     * @param array $users
     *   Stores all the data about all the user.
     * 
     * @return array
     *   It returns array of all the active and inactive user data.
     */
    public function getOnlineUser(array $users) {
        $arr = [];
        forEach($users as $user) {
            $arr[] = [
                'id' => $user->getId(),
                'firstname' => $user->getFirstName(),
                'lastname' => $user->getLastName(),
                'status' => $user->getStatus(),
                'img' => $user->getImg(),
            ];
        }
        return $arr;
    }

    /**
     * Converts array of all post in the form of associative array.
     *
     * @param string $emailId
     *   Stores the email id of the current user.
     * @param array $allPostsDetails
     *   Stores all the data about all the post.
     * 
     * @return array
     *   It returns array of all the posts.
     */
    public function getAllPosts(string $emailId, array $showAllPostsDetails) {
        $arr = [];

        forEach($showAllPostsDetails as $singlePost) {

            $arr2 = [];
            forEach($singlePost->getLikeDetails() as $likeDislikeDel) {
                $arr2[] = [
                    'likeColor' => $likeDislikeDel->getThUp(),
                    'dislikeColor' => $likeDislikeDel->getThDown(),
                ];
            }
            $arr[] = [
                'id' => $singlePost->getId(),
                'title' => $singlePost->getPostDetails(),
                'firstname' => $singlePost->getDetails()->getFirstName(),
                'lastname' => $singlePost->getDetails()->getLastName(),
                'collegeName' => ($singlePost->getDetails()->getCollegeName()) ? $singlePost->getDetails()->getCollegeName() : "null",
                'img' => $singlePost->getDetails()->getImg(),
                'email' => $singlePost->getDetails()->getEmail(),
                'thumsUp' => $singlePost->getThumsUp(),
                'thumsDown' => $singlePost->getThumsDown(),
                'teamName' => $singlePost->getTeamName(),
                'projectName' => $singlePost->getProjectName(),
                'projectDocuments' => $singlePost->getProjectDocments(),
                'loginEmail' => $emailId,
                'likeDislikeColor' => $arr2,
            ];
        }
        return $arr;
    }

    /**
     * Converts object of all comments in the form of array.
     *
     * @param string $emailId
     *   Stores the email id of the current user.
     * @param object $allPostsDetails
     *   Stores all the data about all the comments.
     * 
     * @return array
     *   It returns array of all the comments.
     */
    public function getComments(string $emailId, object $showAllCommentsDetails) {
        $arr = [];

            forEach($showAllCommentsDetails->getComments() as $singleComment) {
                $arr[] = [
                    "id" => $singleComment->getId(),
                    "title" => $singleComment->getComments(),
                    "firstname" => $singleComment->getLoginComments()->getFirstName(),
                    "lastname" => $singleComment->getLoginComments()->getLastName(),
                    "img" => $singleComment->getLoginComments()->getImg(),
                    "email" => $singleComment->getLoginComments()->getEmail(),
                    "loginEmail" => $emailId,
                ];
            }
        return $arr;
    }

    public function getOnlineFriends(array $users, string $emailId) {
        $arr = [];
        forEach($users as $user) {
            if ($user->getUser()->getEmail() == $emailId) {
                $arr[] = [
                    'id' => $user->getFriends()->getId(),
                    'firstname' => $user->getFriends()->getFirstName(),
                    'lastname' => $user->getFriends()->getLastName(),
                    'status' => $user->getFriends()->getStatus(),
                    'img' => $user->getFriends()->getImg(),
                ];
            }
            else {
                $arr[] = [
                    'id' => $user->getUser()->getId(),
                    'firstname' => $user->getUser()->getFirstName(),
                    'lastname' => $user->getUser()->getLastName(),
                    'status' => $user->getUser()->getStatus(),
                    'img' => $user->getUser()->getImg(),
                ];
            }
        }
        return $arr;
    }
}
?>
