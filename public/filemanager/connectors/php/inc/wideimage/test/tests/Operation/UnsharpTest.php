<?php
    /**
     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

     **/

    /**
     * @group operation
     */
    class WideImage_Operation_Unsharp_Test extends WideImage_TestCase
    {
        public function test()
        {
            $img = WideImage::load(IMG_PATH.'100x100-color-hole.gif');
            $result = $img->unsharp(10, 5, 1);

            $this->assertTrue($result instanceof WideImage_PaletteImage);
            $this->assertTrue($result->isTransparent());

            $this->assertEquals(100, $result->getWidth());
            $this->assertEquals(100, $result->getHeight());
        }
    }
