<?php

namespace App\Services;

use RuntimeException;

class S3Uploader
{
    public function upload(string $tmpPath, string $originalName, string $folder): string
    {
        if (!class_exists('Aws\\S3\\S3Client')) {
            throw new RuntimeException('AWS SDK not installed. Run composer install.');
        }

        $bucket = getenv('AWS_S3_BUCKET');
        $region = getenv('AWS_REGION');
        $key = rtrim($folder, '/') . '/' . time() . '_' . basename($originalName);

        $client = new \Aws\S3\S3Client([
            'version' => 'latest',
            'region' => $region,
            'credentials' => [
                'key' => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
            ],
            'endpoint' => getenv('AWS_S3_ENDPOINT') ?: null,
        ]);

        $client->putObject([
            'Bucket' => $bucket,
            'Key' => $key,
            'SourceFile' => $tmpPath,
            'ContentType' => mime_content_type($tmpPath),
            'ContentDisposition' => 'inline',
        ]);

        $publicBase = rtrim(getenv('CLOUDFRONT_MEDIA_BASE_URL') ?: '', '/');
        if ($publicBase === '') {
            $publicBase = rtrim(getenv('S3_PUBLIC_BASE_URL') ?: '', '/');
        }

        if ($publicBase !== '') {
            return $publicBase . '/' . $key;
        }

        return $client->getObjectUrl($bucket, $key);
    }
}
