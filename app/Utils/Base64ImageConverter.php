<?php

namespace App\Utils;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Base64ImageConverter
{
    public string $type;
    public string $image;
    public string $tempName;

    private array $dataType = [];
    private string $tempDir = 'img/tmp';
    private array $allowedTypes = ['jpg', 'jpeg', 'gif', 'png'];    

    public function __construct(
        private string $data
    ) 
    {
        $this->convertURI();
        $this->convertFile();
        $this->convertType();

        $this->convertImageFile();
    }

    /**
     * Convert URI to data and data type.
     *
     * @throws \App\Exceptions\Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    private function convertURI(): void 
    {
        if (!preg_match('/^data:image\/(\w+);base64,/', $this->data, $this->dataType)) 
            throw new BadRequestHttpException('did not match data URI with image data');
    }

    /**
     * Convert data to base64 decoded image.
     *
     * @throws \App\Exceptions\Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    private function convertFile(): void
    {
        $this->data = substr($this->data, strpos($this->data, ',') + 1);
        $this->data = str_replace(' ', '+', $this->data);
        $this->image = base64_decode($this->data);
    
        if ($this->image === false) 
            throw new BadRequestHttpException('base64_decode failed');
    }

    /**
     * Check if the image type is valid.
     *
     * @throws \App\Exceptions\Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    private function convertType(): void
    {
        $this->type = strtolower($this->dataType[1]); // jpg, png, gif

        if (!in_array($this->type, $this->allowedTypes)) 
            throw new BadRequestHttpException('Invalid image type');
    }

    /**
     * Convert base64 to image and returns the temporary name.
     * 
     * @throws \App\Exceptions\Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    private function convertImageFile(): void
    {
        if (!is_dir($this->tempDir)) mkdir($this->tempDir, 0777, true);

        $this->tempName = $this->tempDir . "/image_tmp." . $this->type;

        if (!file_put_contents($this->tempName , $this->image))
            throw new BadRequestHttpException("A imagem não pode ser processada");
    }
}
