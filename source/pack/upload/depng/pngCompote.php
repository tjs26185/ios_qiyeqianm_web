<?php
namespace PngFile;
define('MAGIC_HEADER', b"\x89\x50\x4E\x47\x0D\x0A\x1A\x0A");
define('CGBI_CHUNK_TYPE', 'CgBI');
define('IHDR_CHUNK_TYPE', 'IHDR');
define('IDAT_CHUNK_TYPE', 'IDAT');
define('IEND_CHUNK_TYPE', 'IEND');
define('CHUNK_SIZE_LENGHT', 4);
define('CHUNK_TYPE_LENGHT', 4);
define('CHUNK_CRC_LENGHT', 4);
class PngFile {
    public $filename;
    public $handle;
    public $width = 0;
    public $height = 0;
    public $chunks = array();
    public function __construct($filename) {
        $this->filename = $filename;
        $this->handle = fopen($this->filename, "rb");
        $magic = fread($this->handle, 8);
        if (!strcmp($magic, MAGIC_HEADER) == 0) {
            return FALSE;
        }
        try {
            $idx = ftell($this->handle);
            do {
                $chunk = new PngChunk($this, $idx);
                $this->chunks[] = $chunk;
                $idx = $chunk->getNextChunkIdx();
            } while (strcmp($chunk->type, IEND_CHUNK_TYPE) != 0);
        }
        catch(UnexpectedValueException $e) {
            return FALSE;
        }
        fclose($this->handle);
        $this->handle = NULL;
    } function revertIphone($newFilename) {
        if (!isset($this->isIphone)) {
            return FALSE;
        }
        $this->handle = fopen($this->filename, "rb");
        $newHandle = fopen($newFilename, "wb");
        fwrite($newHandle, MAGIC_HEADER);
        foreach ($this->chunks as $chunk) {
            if (strcmp($chunk->type, CGBI_CHUNK_TYPE) != 0) {
                if ($chunk->dataLength > 0) {
                    $res = fseek($this->handle, $chunk->idxStart + CHUNK_TYPE_LENGHT + CHUNK_SIZE_LENGHT, SEEK_SET);
                    if ($res == - 1) {
                        throw new UnexpectedValueException();
                    }
                    if (strcmp($chunk->type, IDAT_CHUNK_TYPE) == 0) {
                        $data = fread($this->handle, $chunk->dataLength);
                        $data = @gzinflate($data);
                        $dataRes = '';
                        $scanlinesize = 1 + ($this->width * 4);
                        for ($y = 0; $y < $this->height; $y++) {
                            if (isset($data[$y * $scanlinesize])) {
                                $filterType = $data[$y * $scanlinesize];
                            } else {
                                return FALSE;
                            }
                            $dataRes.= $filterType;
                            for ($x = 0; $x < $this->width; $x++) {
                                $pixel = substr($data, ($y * $scanlinesize + 1) + ($x * 4) , 4);
                                $dataRes.= $pixel[2] . $pixel[1] . $pixel[0] . $pixel[3];
                            }
                        }
                        $data = gzcompress($dataRes, 9);
                    } else {
                        $data = fread($this->handle, $chunk->dataLength);
                    }
                } else {
                    $data = '';
                }
                $dataLen = pack('N', mb_strlen($data, '8bit'));
                fwrite($newHandle, $dataLen);
                fwrite($newHandle, $chunk->type);
                fwrite($newHandle, $data);
                $crc = pack('N', crc32($chunk->type . $data));
                fwrite($newHandle, $crc);
            }
        }
        fclose($this->handle);
        fclose($newHandle);
        $this->handle = NULL;
        return TRUE;
    }
} class PngChunk {
    public $png;
    public $idxStart;
    public $type;
    public $dataLength;
    public $crc;
    public function __construct($png, $idx) {
        $this->png = $png;
        $this->idxStart = $idx;
        $res = fseek($this->png->handle, $idx, SEEK_SET);
        if ($res == - 1) {
            throw new UnexpectedValueException();
        }
        $val = fread($this->png->handle, CHUNK_SIZE_LENGHT);
        if ($val == FALSE) {
            throw new UnexpectedValueException();
        }
        $val = unpack('N', $val);
        $this->dataLength = $val[1];
        $val = fread($this->png->handle, CHUNK_TYPE_LENGHT);
        if ($val == FALSE) {
            throw new UnexpectedValueException();
        }
        $this->type = $val;
        $res = fseek($this->png->handle, $this->dataLength, SEEK_CUR);
        if ($res == - 1) {
            throw new UnexpectedValueException();
        }
        $val = fread($this->png->handle, CHUNK_CRC_LENGHT);
        if ($val == FALSE) {
            throw new UnexpectedValueException();
        }
        $this->crc = $val;
        if (strcmp($this->type, CGBI_CHUNK_TYPE) == 0) {
            $this->png->isIphone = TRUE;
        }
        if (strcmp($this->type, IHDR_CHUNK_TYPE) == 0) {
            $res = fseek($this->png->handle, $this->idxStart + CHUNK_SIZE_LENGHT + CHUNK_TYPE_LENGHT, SEEK_SET);
            if ($res == - 1) {
                throw new UnexpectedValueException();
            }
            $val = fread($this->png->handle, $this->dataLength);
            if ($val == FALSE) {
                throw new UnexpectedValueException();
            }
            $val = unpack('Nwidth/Nheight/Cdepth/Ccolor/ccompression/cfilter/Cinterlace', $val);
            $this->png->width = $val['width'];
            $this->png->height = $val['height'];
            $this->png->compression = $val['compression'];
        }
    }
    function getNextChunkIdx() {
        return $this->idxStart + CHUNK_SIZE_LENGHT + CHUNK_TYPE_LENGHT + $this->dataLength + CHUNK_CRC_LENGHT;
    }
}
?>
