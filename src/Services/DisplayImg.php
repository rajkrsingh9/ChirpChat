<?php

namespace App\Services;

/**
 * Checks wheather the user has given his image or not and if userhas 
 * uploaded his image it will save the image and return its location and if 
 * the user not enter his image then acording to his gender it will return 
 * default image.
 * 
 * @method checkingImg().
 *   Checks wheather the user has given his image or not and if userhas 
 *   uploaded his image it will save the image and return its location and if 
 *   the user not enter his image then acording to his gender it will return 
 *   default image.
 * 
 * @property object $image
 *   Stores object of image.
 * @property string $imageName
 *   Stores name of an image.
 * @property string $maleImg
 *   Stores male image path.
 * @property string $femaleImg
 *   Stores female iamge path.
 * @property string $gender
 *   Stores gender of user.
 * 
 * @author Deepak Pandey <deepak.pandey@innoraft.com>
 */
class DisplayImg {
    /**
     * Stores object of image.
     * @var object
     */
    private $image;

    /**
     * Stores name of an image.
     * @var string
     */
    private $imageName;

    /**
     * Stores male iamge path.
     * @var string
     */
    private $maleImg = 'boyAvatar.png';

    /**
     * Stores female iamge path.
     * @var string
     */
    private $femaleImg = 'girlAvatar.png';

    /**
     * Stores gender of user.
     * @var string
     */
    private $gender;

    /**
     * Initilizing the image, imageName and gender.
     * 
     * @param $image
     *   Stores object of image.
     * @param $imageName
     *   Stores name of an image.
     * @param $gender
     *   Stores gender of user.
     */
    public function __construct(mixed $image, string $imageName, string $gender) {
        $this->image = $image;
        $this->imageName = $imageName;
        $this->gender = $gender;
    }
    
    /**
     * Checks wheather the user has given his image or not and if userhas 
     * uploaded his image it will save the image and return its location and if 
     * the user not enter his image then acording to his gender it will return 
     * default image.
     * 
     * @return string
     *   returns the location of an image
     */
    public function checkingImg() {
        if ($this->image) {
            $this->image->move('userImage/', $this->imageName);
            $img = 'userImage/' . $this->imageName;
        }
        else {
            if ($this->gender == 'Male') {
                $img = 'userImage/' . $this->maleImg;
            }
            else {
                $img = 'userImage/' . $this->femaleImg;
            }
        }
        return $img;
    }
}
?>