<?php
    /**
     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

     **/
    include WideImage::path().'Mapper/GIF.php';

    /**
     * @group Mapper
     * @group GIF
     */
    class WideImage_Mapper_GIF_Test extends WideImage_TestCase
    {
        protected $mapper;

        public function setup()
        {
            $this->mapper = WideImage_MapperFactory::selectMapper(null, 'gif');
        }

        public function teardown()
        {
            $this->mapper = null;

            if (file_exists(IMG_PATH.'temp/test.gif')) {
                unlink(IMG_PATH.'temp/test.gif');
            }
        }

        public function testLoad()
        {
            $handle = $this->mapper->load(IMG_PATH.'100x100-color-hole.gif');
            $this->assertTrue(is_resource($handle));
            $this->assertEquals(100, imagesx($handle));
            $this->assertEquals(100, imagesy($handle));
            imagedestroy($handle);
        }

        public function testSaveToString()
        {
            $handle = imagecreatefromgif(IMG_PATH.'100x100-color-hole.gif');
            ob_start();
            $this->mapper->save($handle);
            $string = ob_get_clean();
            $this->assertTrue(strlen($string) > 0);
            imagedestroy($handle);

            // string contains valid image data
            $handle = imagecreatefromstring($string);
            $this->assertTrue(is_resource($handle));
            imagedestroy($handle);
        }

        public function testSaveToFile()
        {
            $handle = imagecreatefromgif(IMG_PATH.'100x100-color-hole.gif');
            $this->mapper->save($handle, IMG_PATH.'temp/test.gif');
            $this->assertTrue(filesize(IMG_PATH.'temp/test.gif') > 0);
            imagedestroy($handle);

            // file is a valid image
            $handle = imagecreatefromgif(IMG_PATH.'temp/test.gif');
            $this->assertTrue(is_resource($handle));
            imagedestroy($handle);
        }
    }
