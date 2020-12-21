<?php

namespace MrMadClown\LaravelMultipartResponse\Http;

use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Http\Response;

class MultipartResponse extends Response
{
    /**
     * MultipartResponse constructor.
     * @param array $elements Array of associative arrays, each containing a
     *                         required "name" key mapping to the form field,
     *                         name, a required "contents" key mapping to a
     *                         StreamInterface/resource/string, an optional
     *                         "headers" associative array of custom headers,
     *                         and an optional "filename" key mapping to a
     *                         string to send as the filename in the part.
     * @param int $status
     * @param array $headers
     */
    public function __construct(array $elements, int $status = 200, array $headers = [])
    {
        $multipartStream = new MultipartStream($elements);

        parent::__construct($multipartStream->getContents(), $status, \array_merge($headers, [
            'Content-Type' => sprintf('multipart/form-data; boundary="%s"', $multipartStream->getBoundary()),
        ]));
    }

    public static function fromDirectory(string $dir, int $status = 200, array $headers = []): self
    {
        $outFiles = \collect(\scandir($dir))
            ->map(static function (string $fileName) use ($dir) {
                $path = sprintf('%s/%s', $dir, $fileName);

                return is_dir($path)
                    ? null
                    : [
                        'name' => $fileName,
                        'contents' => \fopen($path, 'rb'),
                        'filename' => $fileName,
                    ];
            })
            ->filter()
            ->all();

        return new static($outFiles, $status, $headers);
    }
}
