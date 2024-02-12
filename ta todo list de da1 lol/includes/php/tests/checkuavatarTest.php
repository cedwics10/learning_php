<?php
use PHPUnit\Framework\TestCase as TestCase;

class checkuavatarTest extends TestCase
{
    public function testEmptyCheckAvatar() 
    {
        $this->assertEquals(check_uploaded_avatar(), true, 'No file = it\'s ok to get the same image');
    }

    public function testUploadTooBigAvatar() 
    {
        $image_path = 'mock_data/toobigheight.jpg';
        $_FILES = [
            'avatar' => [
                'tmp_name' => $image_path,
                'name' => $image_path,
                'type' => 'image/jpg',
                'error' => 0,
                'size' => getimagesize($image_path)
            ],
        ];
        check_uploaded_avatar();
        $this->assertEquals(check_uploaded_avatar(), false, 'An avatar whose height is too big is refused.');
    }

    public function testUploadMP3()
    {
        $image_path = 'mock_data/notimage.mp3';
        $avatar_extension = pathinfo($image_path,PATHINFO_EXTENSION);

        $_FILES = [
            'avatar' => [
                'tmp_name' => $image_path,
                'name' => $image_path,
                'error' => 0,
                'size' => getimagesize($image_path)
            ],
        ];
        $this->assertEquals(check_uploaded_avatar(), false, 'A file which is not an image is refused');
    }

    // Perform a successful upload test
}
?>