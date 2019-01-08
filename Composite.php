<?php

/**
 * 组合模式
 *
 * 组合模式是一个树状的结构，便于添加和查看其中任意一个节点的信息
 *
 * 举个例子：我们的操作系统中的文件目录其实就是一个很形象的例子，比如目录中很可能还有目录，但是目录下面可能会包含文件、图片、也有可能还有视频，我们先一步一步的来看下，不着急一下子就用到组合模式
 *
 * 假设我们有个病毒扫描软件，需要扫描指定目录内的所有文件
 */

// 文本文件
class TextFile
{
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function killViruses()
    {
        echo '正在查杀文件: ', $this->fileName, ' ...', PHP_EOL;
    }
}

// 图片文件
class ImageFile
{
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function killViruses()
    {
        echo '正在查杀图片: ', $this->fileName, ' ...', PHP_EOL;
    }
}

// 目录
class Catalog
{
    private $name;

    private $textFiles = [];

    private $imageFiles = [];

    private $catalogs = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addTextFIle(TextFile $file)
    {
        $this->textFiles[] = $file;
    }

    public function addImageFile(ImageFile $file)
    {
        $this->imageFiles[] = $file;
    }

    public function addCatalog(Catalog $catalog)
    {
        $this->catalogs[] = $catalog;
    }

    public function killViruses()
    {
        echo '查杀目录: ' . $this->name, PHP_EOL;

        // 递归查杀目录
        foreach ($this->catalogs as $catalog) {
            $catalog->killViruses();
        }

        // 查杀文本文件
        foreach ($this->textFiles as $textFile) {
            $textFile->killViruses();
        }

        // 查杀图片文件
        foreach ($this->imageFiles as $imageFile) {
            $imageFile->killViruses();
        }
    }
}


// 代码测试
$catalog = new Catalog('根目录');
$catalog1 = new Catalog('根目录 - 目录1');
$catalog2 = new Catalog('根目录 - 目录1 - 目录2');

$imageFile = new ImageFile('图片1');
$textFile = new TextFile('文本1');

$catalog2->addImageFile($imageFile);
$catalog2->addTextFIle($textFile);

$catalog1->addTextFIle($textFile);
$catalog1->addCatalog($catalog2);

$catalog->addCatalog($catalog1);

$catalog->killViruses();
