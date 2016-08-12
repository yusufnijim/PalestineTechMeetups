<?php
    /**
     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

     **/
    WideImage_OperationFactory::get('Resize');

    class WideImage_Operation_Resize_Testable extends WideImage_Operation_Resize
    {
        public function prepareDimensions($img, $width, $height, $fit)
        {
            return parent::prepareDimensions($img, $width, $height, $fit);
        }
    }


    class WideImage_Operation_Resize_Test extends WideImage_TestCase
    {
        public function testProxyMethod()
        {
            $op = $this->getMock('WideImage_Operation_Resize', ['execute']);
            $img = $this->getMock('WideImage_PaletteImage', ['getOperation'], [imagecreate(10, 10)]);

            $img->expects($this->exactly(2))->
                method('getOperation')->with('Resize')->
                will($this->returnValue($op));

            $op->expects($this->at(0))->
                method('execute')->with($img, 'WIDTH', 'HEIGHT', 'FIT', 'SCALE');

            $op->expects($this->at(1))->
                method('execute')->with($img, null, null, 'inside', 'any');

            $img->resize('WIDTH', 'HEIGHT', 'FIT', 'SCALE');
            $img->resize();
        }

        public function testResultTypeIsSameAsInput()
        {
            $this->assertInstanceOf('WideImage_PaletteImage', WideImage::createPaletteImage(20, 20)->resize(10, 10));
            $this->assertInstanceOf('WideImage_TrueColorImage', WideImage::createTrueColorImage(20, 20)->resize(10, 10));
        }

        public function testResizeWithoutParametersDoesNothing()
        {
            $img = WideImage::createTrueColorImage(70, 20);
            $res = $img->resize();
            $this->assertDimensions($res, $img->getWidth(), $img->getHeight());
        }

        public function testPreservesTransparency()
        {
            $img = $this->load('100x100-color-hole.gif');
            $this->assertTrue($img->isTransparent());
            $res = $img->resize(50, 50);
            $this->assertTrue($res->isTransparent());
            $this->assertTransparentColorMatch($img, $res);
            $this->assertEquals($res->getColorAt(25, 25), $res->getTransparentColor());
        }

        public function testFitFill()
        {
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'fill'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 30, 'fill'), 120, 30);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(20, 130, 'fill'), 20, 130);
        }

        public function testFitOutside()
        {
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'outside'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 30, 'outside'), 120, 60);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(20, 30, 'outside'), 60, 30);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(20, 100, 'outside'), 200, 100);
        }

        public function testFitInside()
        {
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'inside'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 30, 'inside'), 60, 30);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(20, 30, 'inside'), 20, 10);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(20, 100, 'inside'), 20, 10);
        }

        public function testScaleDown()
        {
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'fill', 'down'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 60, 'fill', 'down'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 40, 'fill', 'down'), 120, 40);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 60, 'fill', 'down'), 90, 60);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 30, 'fill', 'down'), 90, 30);

            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'inside', 'down'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 60, 'inside', 'down'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 40, 'inside', 'down'), 80, 40);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 60, 'inside', 'down'), 90, 45);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 30, 'inside', 'down'), 60, 30);

            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'outside', 'down'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 60, 'outside', 'down'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 40, 'outside', 'down'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 60, 'outside', 'down'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 30, 'outside', 'down'), 90, 45);
        }

        public function testScaleUp()
        {
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'fill', 'up'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 60, 'fill', 'up'), 120, 60);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 40, 'fill', 'up'), 120, 40);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 60, 'fill', 'up'), 90, 60);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 30, 'fill', 'up'), 100, 50);

            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'inside', 'up'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 60, 'inside', 'up'), 120, 60);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 40, 'inside', 'up'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 60, 'inside', 'up'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 30, 'inside', 'up'), 100, 50);

            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(100, 50, 'outside', 'up'), 100, 50);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 60, 'outside', 'up'), 120, 60);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(120, 40, 'outside', 'up'), 120, 60);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 60, 'outside', 'up'), 120, 60);
            $this->assertDimensions(WideImage::createPaletteImage(100, 50)->resize(90, 30, 'outside', 'up'), 100, 50);
        }

        public function testResizeFill()
        {
            $img = WideImage::load(IMG_PATH.'100x100-color-hole.gif');
            $resized = $img->resize(50, 20, 'fill');
            $this->assertTrue($resized instanceof WideImage_Image);
            $this->assertTrue($resized->isTransparent());
            $this->assertEquals(50, $resized->getWidth());
            $this->assertEquals(20, $resized->getHeight());
            $this->assertRGBEqual($resized->getRGBAt(5, 5), 255, 255, 0);
            $this->assertRGBEqual($resized->getRGBAt(45, 5), 0, 0, 255);
            $this->assertRGBEqual($resized->getRGBAt(45, 15), 0, 255, 0);
            $this->assertRGBEqual($resized->getRGBAt(5, 15), 255, 0, 0);

            $this->assertRGBEqual($resized->getRGBAt(25, 10), 255, 255, 255);
            $this->assertRGBEqual($img->getTransparentColorRGB(), 255, 255, 255);
        }

        public function testNullDimensionsAreCalculatedForFill()
        {
            $img = WideImage_TrueColorImage::create(100, 50);
            $resized = $img->resize(30, null, 'fill');
            $this->assertEquals(30, $resized->getWidth());
            $this->assertEquals(15, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(100, 50);
            $resized = $img->resize(null, 30, 'fill');
            $this->assertEquals(60, $resized->getWidth());
            $this->assertEquals(30, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(100, 50);
            $resized = $img->resize(30, 30, 'fill');
            $this->assertEquals(30, $resized->getWidth());
            $this->assertEquals(30, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(100, 50);
            $resized = $img->resize(30, 40, 'fill');
            $this->assertEquals(30, $resized->getWidth());
            $this->assertEquals(40, $resized->getHeight());
        }

        public function testResizeInside()
        {
            $img = WideImage::load(IMG_PATH.'100x100-color-hole.gif');
            $resized = $img->resize(50, 20, 'inside');
            $this->assertTrue($resized instanceof WideImage_Image);
            $this->assertTrue($resized->isTransparent());
            $this->assertEquals(20, $resized->getWidth());
            $this->assertEquals(20, $resized->getHeight());
            /*
            $this->assertRGBEqual($resized->getRGBAt(5, 5), 255, 255, 0);
            $this->assertRGBEqual($resized->getRGBAt(45, 5), 0, 0, 255);
            $this->assertRGBEqual($resized->getRGBAt(45, 15), 0, 255, 0);
            $this->assertRGBEqual($resized->getRGBAt(5, 15), 255, 0, 0);
            $this->assertRGBEqual($resized->getRGBAt(25, 10), 255, 255, 255);
            $this->assertRGBEqual($img->getTransparentColorRGB(), 255, 255, 255);
            */
        }

        public function testResizeDown()
        {
            $img = WideImage_TrueColorImage::create(100, 100);
            $resized = $img->resizeDown(30);
            $this->assertEquals(30, $resized->getWidth());
            $this->assertEquals(30, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(200, 100);
            $resized = $img->resizeDown(100);
            $this->assertEquals(100, $resized->getWidth());
            $this->assertEquals(50, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(200, 100);
            $resized = $img->resizeDown(null, 30);
            $this->assertEquals(60, $resized->getWidth());
            $this->assertEquals(30, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(200, 100);
            $resized = $img->resizeDown(201);
            $this->assertEquals($img->getWidth(), $resized->getWidth());
            $this->assertEquals($img->getHeight(), $resized->getHeight());

            $img = WideImage_TrueColorImage::create(200, 100);
            $resized = $img->resizeDown(null, 300);
            $this->assertEquals($img->getWidth(), $resized->getWidth());
            $this->assertEquals($img->getHeight(), $resized->getHeight());
        }

        public function testResizeUp()
        {
            $img = WideImage_TrueColorImage::create(100, 100);
            $resized = $img->resizeUp(300);
            $this->assertEquals(300, $resized->getWidth());
            $this->assertEquals(300, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(200, 100);
            $resized = $img->resizeUp(300);
            $this->assertEquals(300, $resized->getWidth());
            $this->assertEquals(150, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(20, 10);
            $resized = $img->resizeUp(null, 30);
            $this->assertEquals(60, $resized->getWidth());
            $this->assertEquals(30, $resized->getHeight());

            $img = WideImage_TrueColorImage::create(200, 100);
            $resized = $img->resizeUp(199);
            $this->assertEquals($img->getWidth(), $resized->getWidth());
            $this->assertEquals($img->getHeight(), $resized->getHeight());

            $img = WideImage_TrueColorImage::create(200, 100);
            $resized = $img->resizeUp(null, 10);
            $this->assertEquals($img->getWidth(), $resized->getWidth());
            $this->assertEquals($img->getHeight(), $resized->getHeight());
        }

        public function testResizeBug214()
        {
            $img = WideImage_TrueColorImage::create(1600, 1200);
            $resized = $img->resize(214, null, 'outside');
            $this->assertEquals(214, $resized->getWidth());
            $this->assertEquals(161, $resized->getHeight());
        }
    }
