<?php

// src/App/Helpers

class UploadedFileHandler {
    private array $uploadedFile;
    private int $maxSize;
    private array $acceptedTypes;
    private string $type;


    /**
     * @param array $uploadedFile
     * @param array $acceptedTypes
     * @param int $maxSize
     * @throws Exception
     */
    public function __construct(array $uploadedFile, array $acceptedTypes = [], int $maxSize = 0) {
       if (empty($uploadedFile))
           throw new Exception("No s'ha pujat cap fitxer");

       $this->uploadedFile = $uploadedFile;
       $this->maxSize = $maxSize;

       switch ($this->uploadedFile["error"]) {
           case UPLOAD_ERR_NO_FILE:
               throw new NoUploadedFileException("No s'ha pujat cap fitxer");
           case UPLOAD_ERR_INI_SIZE:
           case UPLOAD_ERR_FORM_SIZE:
           case UPLOAD_ERR_PARTIAL:
               throw new UploadedFileException("Error no controlat en la pujada ({$this->uploadedFile["error"]})" );
       }
       if ($this->uploadedFile["error"] !== UPLOAD_ERR_OK )
           throw new Exception("Error en la pujada");


       if (empty($acceptedTypes) || in_array($this->uploadedFile["type"], $acceptedTypes))
            $this->acceptedTypes = $acceptedTypes;
       else
           throw new InvalidTypeUploadedFileException("El tipus del fitxer no és correcte");

        if ($maxSize != 0 && $this->uploadedFile["size"] > $maxSize)
           throw new TooBigUploadedFileException("El fitxer ({$this->uploadedFile["size"]}) és major que $maxSize");


    }

    /**
     * @param string $path
     * @return string
     * @throws Exception
     */
    public function handle(string $path): string
    {
        //doble-check

        $mimeType = $this->getFileExtension($this->uploadedFile["tmp_name"]);

        if (!empty($this->acceptedTypes) && !in_array($mimeType, $this->acceptedTypes))
            throw new InvalidTypeUploadedFileException("El tipus del fitxer no és correcte 2");

        $extension = explode("/", $mimeType)[1];

        $newFilename = md5((string)rand()) . "." . $extension;
        $newFullFilename = $path . "/" . $newFilename;

        if (!move_uploaded_file($this->uploadedFile["tmp_name"], $newFullFilename))
            throw new UploadedFileException("No s'ha pogut moure la foto");

        return $newFilename;
    }

    private function getFileExtension(string $filename): string
    {
        $mime = "";
        try {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $filename);
            if ($mime === false)
                throw new Exception();
        } // return mime-type extension
        finally {
            finfo_close($finfo);
        }
        return $mime;
    }

}
